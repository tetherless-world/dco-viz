<?php

$dir = 'statsJSON';


$dcoStats["subjectAreas"] = json_decode(file_get_contents("https://info.deepcarbon.net/vivo/admin/sparqlquery?query=PREFIX+rdf%3A+++%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E%0D%0APREFIX+rdfs%3A++%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+xsd%3A+++%3Chttp%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%23%3E%0D%0APREFIX+owl%3A+++%3Chttp%3A%2F%2Fwww.w3.org%2F2002%2F07%2Fowl%23%3E%0D%0APREFIX+swrl%3A++%3Chttp%3A%2F%2Fwww.w3.org%2F2003%2F11%2Fswrl%23%3E%0D%0APREFIX+swrlb%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2003%2F11%2Fswrlb%23%3E%0D%0APREFIX+vitro%3A+%3Chttp%3A%2F%2Fvitro.mannlib.cornell.edu%2Fns%2Fvitro%2F0.7%23%3E%0D%0APREFIX+bibo%3A+%3Chttp%3A%2F%2Fpurl.org%2Fontology%2Fbibo%2F%3E%0D%0APREFIX+c4o%3A+%3Chttp%3A%2F%2Fpurl.org%2Fspar%2Fc4o%2F%3E%0D%0APREFIX+cito%3A+%3Chttp%3A%2F%2Fpurl.org%2Fspar%2Fcito%2F%3E%0D%0APREFIX+dcat%3A+%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fdcat%23%3E%0D%0APREFIX+dco%3A+%3Chttp%3A%2F%2Finfo.deepcarbon.net%2Fschema%23%3E%0D%0APREFIX+event%3A+%3Chttp%3A%2F%2Fpurl.org%2FNET%2Fc4dm%2Fevent.owl%23%3E%0D%0APREFIX+fabio%3A+%3Chttp%3A%2F%2Fpurl.org%2Fspar%2Ffabio%2F%3E%0D%0APREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0APREFIX+geo%3A+%3Chttp%3A%2F%2Faims.fao.org%2Faos%2Fgeopolitical.owl%23%3E%0D%0APREFIX+p.1%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Felements%2F1.1%2F%3E%0D%0APREFIX+p.2%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0APREFIX+obo%3A+%3Chttp%3A%2F%2Fpurl.obolibrary.org%2Fobo%2F%3E%0D%0APREFIX+ocrer%3A+%3Chttp%3A%2F%2Fpurl.org%2Fnet%2FOCRe%2Fresearch.owl%23%3E%0D%0APREFIX+ocresd%3A+%3Chttp%3A%2F%2Fpurl.org%2Fnet%2FOCRe%2Fstudy_design.owl%23%3E%0D%0APREFIX+p.3%3A+%3Chttp%3A%2F%2Fvivoweb.org%2Fontology%2Fprovenance-support%23%3E%0D%0APREFIX+prov%3A+%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fprov%23%3E%0D%0APREFIX+skos%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2004%2F02%2Fskos%2Fcore%23%3E%0D%0APREFIX+vcard%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2006%2Fvcard%2Fns%23%3E%0D%0APREFIX+vitro-public%3A+%3Chttp%3A%2F%2Fvitro.mannlib.cornell.edu%2Fns%2Fvitro%2Fpublic%23%3E%0D%0APREFIX+vivo%3A+%3Chttp%3A%2F%2Fvivoweb.org%2Fontology%2Fcore%23%3E%0D%0APREFIX+scires%3A+%3Chttp%3A%2F%2Fvivoweb.org%2Fontology%2Fscientific-research%23%3E%0D%0A%0D%0ASELECT+%3FsubjectArea+%3FsubjectAreaUri+%28+COUNT%28+%3FsubjectAreaUri+%29+AS+%3Fcount+%29%0D%0AWHERE%0D%0A%7B%0D%0A++++++%3FsubjectAreaUri+vivo%3AsubjectAreaFor+%3Fo+.%0D%0A++++++%3FsubjectAreaUri+rdfs%3Alabel+%3FsubjectArea+.%0D%0A++++++%0D%0A%7D%0D%0AGROUP+BY+%3FsubjectArea+%3FsubjectAreaUri%0D%0ALIMIT+100%0D%0A&resultFormat=RS_JSON&rdfResultFormat=RDF%2FXML-ABBREV"), true);

$dcoStats["expertiseAreas"] = json_decode(file_get_contents("https://info.deepcarbon.net/vivo/admin/sparqlquery?query=PREFIX+rdf%3A+++%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E%0D%0APREFIX+rdfs%3A++%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+xsd%3A+++%3Chttp%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%23%3E%0D%0APREFIX+owl%3A+++%3Chttp%3A%2F%2Fwww.w3.org%2F2002%2F07%2Fowl%23%3E%0D%0APREFIX+swrl%3A++%3Chttp%3A%2F%2Fwww.w3.org%2F2003%2F11%2Fswrl%23%3E%0D%0APREFIX+swrlb%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2003%2F11%2Fswrlb%23%3E%0D%0APREFIX+vitro%3A+%3Chttp%3A%2F%2Fvitro.mannlib.cornell.edu%2Fns%2Fvitro%2F0.7%23%3E%0D%0APREFIX+agu-index%3A+%3Chttp%3A%2F%2Fdeepcarbon.net%2Fontology%2Fagu-index%23%3E%0D%0APREFIX+bibo%3A+%3Chttp%3A%2F%2Fpurl.org%2Fontology%2Fbibo%2F%3E%0D%0APREFIX+c4o%3A+%3Chttp%3A%2F%2Fpurl.org%2Fspar%2Fc4o%2F%3E%0D%0APREFIX+cito%3A+%3Chttp%3A%2F%2Fpurl.org%2Fspar%2Fcito%2F%3E%0D%0APREFIX+dcat%3A+%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fdcat%23%3E%0D%0APREFIX+dco%3A+%3Chttp%3A%2F%2Finfo.deepcarbon.net%2Fschema%23%3E%0D%0APREFIX+event%3A+%3Chttp%3A%2F%2Fpurl.org%2FNET%2Fc4dm%2Fevent.owl%23%3E%0D%0APREFIX+fabio%3A+%3Chttp%3A%2F%2Fpurl.org%2Fspar%2Ffabio%2F%3E%0D%0APREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0APREFIX+geo%3A+%3Chttp%3A%2F%2Faims.fao.org%2Faos%2Fgeopolitical.owl%23%3E%0D%0APREFIX+p.1%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Felements%2F1.1%2F%3E%0D%0APREFIX+p.2%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0APREFIX+obo%3A+%3Chttp%3A%2F%2Fpurl.obolibrary.org%2Fobo%2F%3E%0D%0APREFIX+ocrer%3A+%3Chttp%3A%2F%2Fpurl.org%2Fnet%2FOCRe%2Fresearch.owl%23%3E%0D%0APREFIX+ocresd%3A+%3Chttp%3A%2F%2Fpurl.org%2Fnet%2FOCRe%2Fstudy_design.owl%23%3E%0D%0APREFIX+p.3%3A+%3Chttp%3A%2F%2Fvivoweb.org%2Fontology%2Fprovenance-support%23%3E%0D%0APREFIX+prov%3A+%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fprov%23%3E%0D%0APREFIX+skos%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2004%2F02%2Fskos%2Fcore%23%3E%0D%0APREFIX+vcard%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2006%2Fvcard%2Fns%23%3E%0D%0APREFIX+vitro-public%3A+%3Chttp%3A%2F%2Fvitro.mannlib.cornell.edu%2Fns%2Fvitro%2Fpublic%23%3E%0D%0APREFIX+vivo%3A+%3Chttp%3A%2F%2Fvivoweb.org%2Fontology%2Fcore%23%3E%0D%0APREFIX+scires%3A+%3Chttp%3A%2F%2Fvivoweb.org%2Fontology%2Fscientific-research%23%3E%0D%0A%0D%0ASELECT+DISTINCT+%3FexpertiseName+%3FexpertiseUri+%28COUNT+%28%3Fperson%29+AS+%3Fcount%29%0D%0AWHERE%0D%0A%7B%0D%0A%3FexpertiseUri+vivo%3AresearchAreaOf+%3Fperson+.%0D%0A%3Fperson+rdf%3Atype+foaf%3APerson+.%0D%0A%3FexpertiseUri+rdfs%3Alabel+%3FexpertiseName+.%0D%0AFILTER+%28%3FexpertiseUri+%21%3D+%3Chttp%3A%2F%2Finfo.deepcarbon.net%2Findividual%2Fa7bc1230-44af-4a01-84cf-e4d7bf5643d8%3E%29%0D%0A%7D%0D%0AGROUP+BY+%3FexpertiseUri+%3FexpertiseName%0D%0AORDER+BY+DESC%28%3Fcount%29+%3FexpertiseName&resultFormat=RS_JSON&rdfResultFormat=RDF%2FXML-ABBREV"), true);

$dcoStats["communityPubCounts"] = json_decode(file_get_contents("https://info.deepcarbon.net/vivo/admin/sparqlquery?query=PREFIX+rdfs%3A++%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+dco%3A+%3Chttp%3A%2F%2Finfo.deepcarbon.net%2Fschema%23%3E%0D%0APREFIX+bibo%3A+%3Chttp%3A%2F%2Fpurl.org%2Fontology%2Fbibo%2F%3E%0D%0A%0D%0A%23%0D%0A%23Counts+the+number+of+publications+on+the+DCO+website%0D%0A%23Sorts+the+publications+by+DCO+community%0D%0A%23%0D%0ASELECT+%3Fdcocommname+%28COUNT%28%3Fpublication%29+as+%3Fnumber%29+WHERE%0D%0A%7B%0D%0A%7B+%3Fpublication+a+bibo%3AArticle+.+%7D+%0D%0AUNION+%7B+%3Fpublication+a+bibo%3ABook+.+%7D+%0D%0AUNION+%7B+%3Fpublication+a+bibo%3ADocumentPart+.+%7D+%0D%0AUNION+%7B+%3Fpublication+a+dco%3APoster+.+%7D+%0D%0AUNION+%7B+%3Fpublication+a+bibo%3AThesis+.+%7D%0D%0A%3Fpublication+dco%3AassociatedDCOCommunity+%3Fdcocomm.%0D%0A%3Fdcocomm+rdfs%3Alabel+%3Fdcocommname.%0D%0A%7D%0D%0AGROUP+BY+%3Fdcocommname&resultFormat=RS_JSON&rdfResultFormat=RDF%2FXML-ABBREV"), true);

$dcoStats["communityMemberCounts1"] = json_decode(file_get_contents("https://info.deepcarbon.net/vivo/admin/sparqlquery?query=PREFIX+rdfs%3A++%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+dco%3A+%3Chttp%3A%2F%2Finfo.deepcarbon.net%2Fschema%23%3E%0D%0APREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0APREFIX+obo%3A+%3Chttp%3A%2F%2Fpurl.obolibrary.org%2Fobo%2F%3E%0D%0APREFIX+vivo%3A+%3Chttp%3A%2F%2Fvivoweb.org%2Fontology%2Fcore%23%3E%0D%0A%0D%0A%23This+query+gets+the+names+of+each+DCO+community+and+counts+the+number+of+users+in+%0D%0A%23each+community%0D%0ASELECT+%3Fdcocommname+%28COUNT%28%3Fuser%29+as+%3Fnumber%29+WHERE%0D%0A%7B%0D%0A++++%3Fuser+a+foaf%3APerson+.%0D%0A+++++%3Fuser+%3Chttp%3A%2F%2Fvivo.mydomain.edu%2Fns%23networkId%3E+%3FnetID+.%0D%0A+++++%3Fuser+obo%3ARO_0000053+%3Fcommrole+.%0D%0A+++++%3Fcommrole+a+vivo%3AMemberRole+.%0D%0A++++OPTIONAL+%7B+%3Fcommrole+vivo%3AdateTimeINterval+%3Finterval+.%0D%0A+++++++++++++++++++++++++%3Finterval+vivo%3Aend+%3Fend+.+%7D%0D%0A++++FILTER%28%21BOUND%28%3Fend%29%29%0D%0A++++%3Fcommrole+vivo%3AroleContributesTo+%3Fdco_community+.%0D%0A++++%3Fdco_community+a+dco%3AResearchCommunity+.%0D%0A++++%3Fdco_community+rdfs%3Alabel+%3Fdcocommname+.%0D%0A%7D%0D%0AGROUP+BY+%3Fdcocommname%0D%0A&resultFormat=RS_JSON&rdfResultFormat=RDF%2FXML-ABBREV"), true);

$dcoStats["communityMemberCounts2"] = json_decode(file_get_contents("https://info.deepcarbon.net/vivo/admin/sparqlquery?query=PREFIX+rdfs%3A++%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+dco%3A+%3Chttp%3A%2F%2Finfo.deepcarbon.net%2Fschema%23%3E%0D%0APREFIX+bibo%3A+%3Chttp%3A%2F%2Fpurl.org%2Fontology%2Fbibo%2F%3E%0D%0A%0D%0A%23%0D%0A%23Counts+the+number+of+publications+on+the+DCO+website%0D%0A%23Sorts+the+publications+by+DCO+community%0D%0A%23%0D%0ASELECT+%3Fdcocommname+%28COUNT%28%3Fpublication%29+as+%3Fnumber%29+WHERE%0D%0A%7B%0D%0A%7B+%3Fpublication+a+bibo%3AArticle+.+%7D+%0D%0AUNION+%7B+%3Fpublication+a+bibo%3ABook+.+%7D+%0D%0AUNION+%7B+%3Fpublication+a+bibo%3ADocumentPart+.+%7D+%0D%0AUNION+%7B+%3Fpublication+a+dco%3APoster+.+%7D+%0D%0AUNION+%7B+%3Fpublication+a+bibo%3AThesis+.+%7D%0D%0A%3Fpublication+dco%3AassociatedDCOCommunity+%3Fdcocomm.%0D%0A%3Fdcocomm+rdfs%3Alabel+%3Fdcocommname.%0D%0A%7D%0D%0AGROUP+BY+%3Fdcocommname&resultFormat=RS_JSON&rdfResultFormat=RDF%2FXML-ABBREV"), true);


// Display sparql response
// var_dump(json_decode($subjectAreas, true));

// echo "<ul>";
// foreach ( $subjectAreas["results"]["bindings"] as $result ) {
//
//     echo "<li>".$result["subjectArea"]["value"]."</li>";
// }
// echo "</ul>";


// $fp = fopen($dir.'/dcoStats.json', 'w');
// fwrite($fp, json_encode(array("subjectAreas"=>$dcoStats["subjectAreas"],"expertiseAreas"=>$dcoStats["expertiseAreas"],"communityPubCounts"=>$dcoStats["communityPubCounts"],"communityMemberCounts1"=>$dcoStats["communityMemberCounts1"],"communityMemberCounts2"=>$dcoStats["communityMemberCounts2"])));
// fclose($fp);

$fp = fopen($dir.'/subjectAreas.json', 'w');
fwrite($fp, json_encode($dcoStats["subjectAreas"]));
fclose($fp);

$fp = fopen($dir.'/expertiseAreas.json', 'w');
fwrite($fp, json_encode($dcoStats["expertiseAreas"]));
fclose($fp);

$fp = fopen($dir.'/communityPubCounts.json', 'w');
fwrite($fp, json_encode($dcoStats["communityPubCounts"]));
fclose($fp);

$fp = fopen($dir.'/communityMemberCounts1.json', 'w');
fwrite($fp, json_encode($dcoStats["communityMemberCounts1"]));
fclose($fp);

$fp = fopen($dir.'/communityMemberCounts2.json', 'w');
fwrite($fp, json_encode($dcoStats["communityMemberCounts2"]));
fclose($fp);

echo "\nrefreshed!";

?>
