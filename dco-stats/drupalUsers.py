import MySQLdb
from SPARQLWrapper import SPARQLWrapper, JSON
import json
from rdflib import Namespace, RDF

endpoint = "http://localhost:3030/VIVO/query"

userquery = ("select uid,name from users where datediff(now(),date(from_unixtime(login))) < 30 ORDER BY name;")

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
    cnx = MySQLdb.connect( user='dco_drupal',
                                   passwd='AManOnlyLivesOnce',
                                   host='localhost',
                                   db='dco_drupal' )
    cursor = cnx.cursor()
    cursor.execute( userquery )
    num = 0
    for( uid, name ) in cursor:
        if( uid != 1 ):
            num+=1
            communityAdd( name )
    print( "Number of users logged in to Community Portal in last 30 days: {}".format( num ) )
    for key, value in communities.items():
        print( "    {} {}".format( key, value ) )

    cursor.close()
except MySQLdb.Error as err:
    if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
        print("Something is wrong with your user name or password")
    elif err.errno == errorcode.ER_BAD_DB_ERROR:
        print("Database does not exist")
    else:
        print(err)
else:
    cnx.close()

