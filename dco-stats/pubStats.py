from dcoStats import DCOStats

query = "where { ?obj a bibo:Article }"

objFile = "pubObjs"
cntFile = "pubCount"
rqFile = "pub.rq"

communities = {}
teamlist = {}

def printIt( uri, jObj ):
    if jObj and len( jObj ) > 0 and "title" in jObj[0]:
        print( jObj[0]["title"]["value"] )
        if "dcoId" in jObj[0]:
            print( "    DCO-ID: " + jObj[0]["dcoId"]["value"] )
        print( "    Publication Type: " + jObj[0]["type"]["value"] )
        if "contrib" in jObj[0]:
            print( "    Is Contribution to the DCO: " + jObj[0]["contrib"]["value"] )
        else:
            print( "    Is Contribution to the DCO: No" ) ;
        if "year" in jObj[0]:
            print( "    Publication Year: " + jObj[0]["year"]["value"] )
        if "doi" in jObj[0]:
            print( "    DOI: " + jObj[0]["doi"]["value"] )
        if "journal" in jObj[0]:
            print( "    Journal: " + jObj[0]["journal"]["value"] )
        if "Authors" in jObj[0]:
            print( "    Authors: " + jObj[0]["Authors"]["value"] )
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
        print( "Missing or no information for Publication " + uri )
    print( "" )

print( "Articles" )
stats = DCOStats()
stats.getNew( query, objFile, query, cntFile, rqFile, printIt )
for key, value in communities.items():
    print( "    {} {}".format( key, value ) )
for key, value in teamlist.items():
    print( "    {} {}".format( key, value ) )
print( "" )

