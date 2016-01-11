from dcoStats import DCOStats

query = "where { ?obj a dco:FieldStudy }"

objFile = "fsObjs"
cntFile = "fsCount"
rqFile = "fs.rq"

communities = {}
teamlist = {}

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
        if "Teams" in jObj[0]:
            teams = jObj[0]["Teams"]["value"]
            print( "    Teams: " + teams )
            for team in teams.split(';'):
                if team in teamlist:
                    teamlist[comm]+=1
                else:
                    teamlist[comm] = 1
    else:
        print( "Missing or no information for Field Study " + uri )
    print( "" )

print( "Field Studies" )
stats = DCOStats()
stats.getNew( query, objFile, query, cntFile, rqFile, printIt )
for key, value in communities.items():
    print( "    {} {}".format( key, value ) )
for key, value in teamlist.items():
    print( "    {} {}".format( key, value ) )
print( "" )

