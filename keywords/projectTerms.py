from SPARQLWrapper import SPARQLWrapper, JSON
import json
from rdflib import Namespace, RDF
from HTMLParser import HTMLParser

endpoint = "https://info.deepcarbon.net/fuseki/VIVO/query"

descriptQuery = ""\
"PREFIX rdf:   <http://www.w3.org/1999/02/22-rdf-syntax-ns#>"\
"PREFIX rdfs:  <http://www.w3.org/2000/01/rdf-schema#>"\
"PREFIX dco: <http://info.deepcarbon.net/schema#>"\
"PREFIX vivo: <http://vivoweb.org/ontology/core#>"\
""\
"select ?descript where { ?proj a vivo:Project . ?proj vivo:description ?descript . }"

def select(query):
    sparql = SPARQLWrapper(endpoint)
    sparql.setQuery(query)
    sparql.setReturnFormat(JSON)
    results = sparql.query().convert()
    return results["results"]["bindings"]

class MLStripper(HTMLParser):
    def __init__(self):
        self.reset()
        self.fed = []
    def handle_data(self, d):
        self.fed.append(d)
    def handle_entityref(self, name):
        self.fed.append('&%s;' % name)
    def get_data(self):
        return ''.join(self.fed)

def html_to_text(html):
    s = MLStripper()
    s.feed(html)
    return s.get_data()

jObj = select( descriptQuery )
if jObj and len( jObj ) > 0:
    for j in jObj:
        cleanstr = html_to_text( j["descript"]["value"] )
        print( cleanstr )

