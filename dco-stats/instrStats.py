from dcoStats import DCOStats

query = "where { ?obj a obo:ERO_0000004 }"

objFile = "instrObjs"
cntFile = "instrCount"
rqFile = "instr.rq"

communities = {}

def printIt( uri, jObj ):
    if jObj and len( jObj ) > 0 and "title" in jObj[0]:
        print( jObj[0]["title"]["value"] )
        if "dcoId" in jObj[0]:
            print( "    DCO-ID: " + jObj[0]["dcoId"]["value"] )
        if "doi" in jObj[0]:
            print( "    DOI: " + jObj[0]["doi"]["value"] )
        if "Communities" in jObj[0]:
            comms = jObj[0]["Communities"]["value"]
            print( "    Communities: " + comms )
            for comm in comms.split(';'):
                if comm in communities:
                    communities[comm]+=1
                else:
                    communities[comm] = 1
    else:
        print( "Missing or no information for Instrument " + uri )
    print( "" )

print( "Instruments" )
stats = DCOStats()
stats.getNew( query, objFile, query, cntFile, rqFile, printIt )
for key, value in communities.items():
    print( "    {} {}".format( key, value ) )
print( "" )

