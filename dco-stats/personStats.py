from dcoStats import DCOStats
import json

query = "where { ?obj a foaf:Person }"

objFile = "personObjs"
cntFile = "personCount"
rqFile = "people.rq"

communities = {}
numMembers = 0

def printIt( uri, jObj ):
    global communities
    global numMembers
    if jObj and len( jObj ) > 0 and "Name" in jObj[0]:
        print( jObj[0]["Name"]["value"] )
        if "dcoId" in jObj[0]:
            print( "    DCO-ID: " + jObj[0]["dcoId"]["value"] )
        if "Uid" in jObj[0]:
            print( "    Usernames: " + jObj[0]["Uid"]["value"] )
            numMembers = numMembers + 1
        if "Country" in jObj[0]:
            print( "    Country: " + jObj[0]["Country"]["value"] )
        if "Organizations" in jObj[0]:
            print( "    Organizations: " + jObj[0]["Organizations"]["value"] )
        if "Communities" in jObj[0]:
            comms = jObj[0]["Communities"]["value"]
            print( "    Communities: " + comms )
            for comm in comms.split(';'):
                if comm in communities:
                    communities[comm]+=1
                else:
                    communities[comm] = 1
        if "AreasOfExpertise" in jObj[0]:
            print( "    AreasOfExpertise: " + jObj[0]["AreasOfExpertise"]["value"] )
    else:
        print( "Missing or no information for Person " + uri )
    print( "" )

print( "People" )
stats = DCOStats()
stats.getNew( query, objFile, query, cntFile, rqFile, printIt )
print( "    Number of new members: {}".format( numMembers ) )
for key, value in communities.items():
    print( "    {} {}".format( key, value ) )
print( "" )

