import MySQLdb
from SPARQLWrapper import SPARQLWrapper, JSON
import json
from rdflib import Namespace, RDF
import datetime, time

endpoint = "https://info.deepcarbon.net/fuseki/VIVO/query"

userquery = ("select b.Obj as uid,a.Obj as logintime from (select Subj,Obj from jena_g4t1_stmt where Prop = \"Uv::http://vitro.mannlib.cornell.edu/ns/vitro/authorization#lastLoginTime:\") a, jena_g4t1_stmt b where a.Subj = b.Subj and b.Prop = \"Uv::http://vitro.mannlib.cornell.edu/ns/vitro/authorization#externalAuthId:\";")

baseQuery = ""\
"PREFIX rdfs:  <http://www.w3.org/2000/01/rdf-schema#>\n"\
"PREFIX xsd:   <http://www.w3.org/2001/XMLSchema#>\n"\
"PREFIX vitro: <http://vitro.mannlib.cornell.edu/ns/vitro/0.7#>\n"\
"PREFIX bibo: <http://purl.org/ontology/bibo/>\n"\
"PREFIX dco: <http://info.deepcarbon.net/schema#>\n"\
"PREFIX event: <http://purl.org/NET/c4dm/event.owl#>\n"\
"PREFIX foaf: <http://xmlns.com/foaf/0.1/>\n"\
"PREFIX vivo: <http://vivoweb.org/ontology/core#>\n"\
"\n"\
"select (str(?name) as ?Name) (GROUP_CONCAT(distinct ?comm_l; separator=';') as ?Communities)\n"\
"WHERE\n"\
"{\n"\
"  ?person <http://vivo.mydomain.edu/ns#networkId> ?uid .\n"\
"  FILTER (str(?uid)=\"UID\")\n"\
"  ?person rdfs:label ?name .\n"\
"  OPTIONAL { ?person dco:associatedDCOCommunity ?comm . ?comm rdfs:label ?comm_l . }\n"\
"} GROUP BY ?name\n"

communities = {}

def select(query):
    sparql = SPARQLWrapper(endpoint)
    sparql.setQuery(query)
    sparql.setReturnFormat(JSON)
    results = sparql.query().convert()
    return results["results"]["bindings"]

def communityAdd( name ):
    query = baseQuery.replace( "UID", name )
    # run the sparql query using select method above
    jObj = select( query )
    if jObj and len( jObj ) > 0 and "Communities" in jObj[0]:
        comms = jObj[0]["Communities"]["value"]
        for comm in comms.split(';'):
            if comm in communities:
                communities[comm]+=1
            else:
                communities[comm] = 1

try:
    cnx = MySQLdb.connect( user='vivo',
                                   passwd='vivo',
                                   host='localhost',
                                   db='vivo' )
    cursor = cnx.cursor()
    cursor.execute( userquery )
    num = 0
    for( uid, logintime ) in cursor:
        name = uid[47:len(uid)-1]
        elastlogin = int(logintime[45:len(logintime)-1])
        lastlogin = datetime.datetime.fromtimestamp(elastlogin/1000)
        thirtydays = datetime.datetime.now() - datetime.timedelta( days = 30 )
        if( lastlogin > thirtydays ):
            num+=1
            communityAdd( name )
    print( "Number of users logged in to Data Portal in last 30 days: {}".format( num ) )
    for key, value in communities.items():
        print( "    {} {}".format( key, value ) )

    cursor.close()
except MySQLdb.Error as err:
    print(err)
else:
    cnx.close()

