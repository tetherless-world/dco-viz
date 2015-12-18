__author__ = 'pwest'

from SPARQLWrapper import SPARQLWrapper, JSON
import json
from rdflib import Namespace, RDF
import datetime
import argparse
import os

parser = argparse.ArgumentParser()
parser.add_argument('--base', default="/opt/backups/stats", help='default stats base directory (default = /opt/backups/stats)')
args = parser.parse_args()
basedir = args.base

DCO = Namespace("http://info.deepcarbon.net/schema#")
endpoint = "http://localhost:3030/VIVO/query"

prefix = ""\
"PREFIX dco:   <http://info.deepcarbon.net/schema#>\n"\
"PREFIX rdf:   <http://www.w3.org/1999/02/22-rdf-syntax-ns#>\n"\
"PREFIX rdfs:  <http://www.w3.org/2000/01/rdf-schema#>\n"\
"PREFIX xsd:   <http://www.w3.org/2001/XMLSchema#>\n"\
"PREFIX owl:   <http://www.w3.org/2002/07/owl#>\n"\
"PREFIX vitro: <http://vitro.mannlib.cornell.edu/ns/vitro/0.7#>\n"\
"PREFIX bibo:  <http://purl.org/ontology/bibo/>\n"\
"PREFIX dcat:  <http://www.w3.org/ns/dcat#>\n"\
"PREFIX foaf:  <http://xmlns.com/foaf/0.1/>\n"\
"PREFIX obo:   <http://purl.obolibrary.org/obo/>\n"\
"PREFIX skos:  <http://www.w3.org/2004/02/skos/core#>\n"\
"PREFIX vivo:  <http://vivoweb.org/ontology/core#>\n"

objSelect = "select distinct ?obj"
cntSelect = "select (count(distinct ?obj) as ?c)"

class DCOStats:

    def select(self, query):
        sparql = SPARQLWrapper(endpoint)
        sparql.setQuery(query)
        sparql.setReturnFormat(JSON)
        results = sparql.query().convert()
        return results["results"]["bindings"]

    def getNewCount(self, query):
        useQuery = prefix + cntSelect + " " + query
        jobj = self.select(useQuery)
        # run the query which returns a json object
        # get the count and return it
        return jobj[0]['c']['value']

    def getOldCount(self, countFile):
        oldCount = 0
        if os.path.exists( countFile ):
            # open the file
            file = open(countFile, 'r')
            # read the old count
            for line in file:
                oldLine = line.rstrip()
            oldSplit = oldLine.split()
            oldCount = oldSplit[0]
            # close the file
            file.close()
        return oldCount

    def saveNewCount(self, countFile, newCount):
        # open the file to append to it
        file = open(countFile, 'a')
        # write the new count
        today = datetime.date.today()
        file.write(str(newCount) + " " + str(today) + "\n")
        # close the file
        file.close()

    def getNumNewObjs(self, query, countFile):
        newCount = self.getNewCount(query)
        oldCount = self.getOldCount(countFile)
        self.saveNewCount(countFile, newCount)
        newCnt = int(newCount) - int(oldCount)
        return newCnt

    def getNewURIs(self, objQuery):
        newURIs = []
        useQuery = prefix + "\n\n" + objSelect + " " + objQuery
        # run the query which returns a json object
        jobj = self.select(useQuery)
        # iterate through result list and add the uri to the new list
        for result in jobj:
            newURIs.append(result['obj']['value'])
        return newURIs

    def getOldURIs(self, objFile):
        oldList = []
        if os.path.exists( objFile ):
            # open the file
            file = open(objFile, 'r')
            # read each line and create a dictionary from it
            oldList = [line.rstrip() for line in file]
            file.close()
        return oldList

    def saveNewURIs(self, objFile, objList):
        # open the file to write, truncate the file
        file = open(objFile, 'w')
        # iterate through the list and dump to file
        for uri in objList:
            file.write(uri + "\n")
        file.close()

    def getNewObjs(self, objQuery, objFile):
        # run the query to get the new objects
        currList = self.getNewURIs(objQuery)
        # read the old list from the file
        oldList = self.getOldURIs(objFile)
        # find the list of new uris
        newList = []
        for uri in currList:
            if uri not in oldList:
                newList.append(uri)
        # write the new list to the file
        self.saveNewURIs(objFile, currList)
        return newList

    def getNew(self, objQuery, objFile, cntQuery, cntFile, rqFile, printFunc):
        objFile = basedir + "/" + objFile
        cntFile = basedir + "/" + cntFile
        rqFile = basedir + "/" + rqFile

        newCount = self.getNumNewObjs(cntQuery, cntFile)
        print( "number of new individuals  = " + str(newCount) )
        newList = self.getNewObjs(objQuery, objFile)

        # load the rqFile into a string
        with open( rqFile, "r" ) as myfile:
            baseQuery = myfile.read()

        for uri in newList:
            # replace a keyword with the uri
            query = baseQuery.replace( "URI", uri )
            # run the sparql query using select method above
            jObj = self.select( query )
            # send the json object to the printFunc
            printFunc( uri, jObj )

