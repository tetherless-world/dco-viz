from dcoStats import DCOStats

query = "where { ?obj a vivo:Project }"

objFile = "projObjs"
cntFile = "projCount"
rqFile = "proj.rq"

communities = {}

def printIt( uri, jObj ):
    if jObj and len( jObj ) > 0 and "title" in jObj[0]:
        print( jObj[0]["title"]["value"] )
        if "dcoId" in jObj[0]:
            print( "    DCO-ID: " + jObj[0]["dcoId"]["value"] )
        if "doi" in jObj[0]:
            print( "    DOI: " + jObj[0]["doi"]["value"] )
        if "year" in jObj[0]:
            print( "    Publication Year: " + jObj[0]["year"]["value"] )
        if "Participants" in jObj[0]:
            print( "    Participants: " + jObj[0]["Participants"]["value"] )
        if "Communities" in jObj[0]:
            comms = jObj[0]["Communities"]["value"]
            print( "    Communities: " + comms )
            for comm in comms.split(';'):
                if comm in communities:
                    communities[comm]+=1
                else:
                    communities[comm] = 1
    else:
        print( "Missing or no information for Project " + uri )
    print( "" )

print( "Projects" )
stats = DCOStats()
stats.getNew( query, objFile, query, cntFile, rqFile, printIt )
for key, value in communities.items():
    print( "    {} {}".format( key, value ) )
print( "" )

