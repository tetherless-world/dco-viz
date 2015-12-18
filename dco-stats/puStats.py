from dcoStats import DCOStats

query = "where { ?obj a dco:ProjectUpdate . ?obj dco:forReportingYear <http://info.deepcarbon.net/individual/n33426> . }"

objFile = "puObjs"
cntFile = "puCount"
rqFile = "pu.rq"

def printIt( uri, jObj ):
    if jObj and len( jObj ) > 0 and "Name" in jObj[0]:
        print( jObj[0]["Name"]["value"] )
        if "dcoId" in jObj[0]:
            print( "    DCO-ID: " + jObj[0]["dcoId"]["value"] )
        if "ReportingYear" in jObj[0]:
            print( "    For Reporting year: " + jObj[0]["ReportingYear"]["value"] )
        if "Project" in jObj[0]:
            print( "    For Project: " + jObj[0]["Project"]["value"] )
        if "EnteredBy" in jObj[0]:
            print( "    Entered By: " + jObj[0]["EnteredBy"]["value"] )
    else:
        print( "Missing or no information for Project Update " + uri )
    print( "" )

print( "Project Updates" )
stats = DCOStats()
stats.getNew( query, objFile, query, cntFile, rqFile, printIt )
print( "" )

