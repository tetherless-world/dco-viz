from dcoStats import DCOStats

query = "where { ?obj a bibo:Article }"

objFile = "pubObjs"
cntFile = "pubCount"
rqFile = "pub.rq"

communities = {}
teamlist = {}

def printIt( uri, jObj ):
    if jObj and len( jObj ) > 0 and "title" in jObj[0]:
        print( "<br/>" )
        if "contrib" in jObj[0]:
            print( "Is Contribution to the DCO: " + jObj[0]["contrib"]["value"] + "<br/>"  )
        else:
            print( "Is Contribution to the DCO: No" + "<br/>"  )
        #if "dcoId" in jObj[0]:
        #    print( "    DCO-ID: " + jObj[0]["dcoId"]["value"] + "<br/>"  )
        print( "    ", end=" " )
        if "Authors" in jObj[0]:
            print( jObj[0]["Authors"]["value"].replace(";",","), end=" " )
        if "year" in jObj[0]:
            print( "(" + jObj[0]["year"]["value"] + ")", end=" " )
        if "doi" in jObj[0]:
            print( "<a href=\"http://dx.doi.org/" + jObj[0]["doi"]["value"] + "\">", end=" " )
            print( jObj[0]["title"]["value"], end=" " )
            print( "</a>.", end=" " )
        else:
            print( jObj[0]["title"]["value"] + ".", end=" " )
        if "journal" in jObj[0]:
            print( jObj[0]["journal"]["value"], end=" " )
            if "volume" in jObj[0]:
                print( jObj[0]["volume"]["value"], end="" )
            if "issue" in jObj[0]:
                print( "(" + jObj[0]["issue"]["value"] + ")", end="" )
            if "pagestart" in jObj[0]:
                print( ":" + jObj[0]["pagestart"]["value"] + "-", end="" )
            if "pageend" in jObj[0]:
                print( jObj[0]["pageend"]["value"], end="" )
        print( "<br/>" )
        if "Communities" in jObj[0]:
            comms = jObj[0]["Communities"]["value"]
            for comm in comms.split(';'):
                if comm in communities:
                    communities[comm]+=1
                else:
                    communities[comm] = 1
        if "Teams" in jObj[0]:
            teams = jObj[0]["Teams"]["value"]
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

