<?
/*
 * Example found somewhere in the web
 * I wanted to create a really simple XML parser, but I found the array management in xml_parse a bit daunting.
 * So I flattened my XML and parsed it using string matching. It wouldn't be difficult to add xml depth 
 * (of 2 plus levels) by modifying the parsedXML array.
*/
// here's the raw xml
$xmlRaw="<order>Order data</order><label>Label data</label><control>123</control>";
// here are the xml field names
$xmlFieldNames=array("order", "label", "control");
// for each xml field...
foreach ($xmlFieldNames as $xmlField) {
    if(strpos($xmlRaw,$xmlField)!==false){
        // I've broken 1 single line into 4 for display purposes
        $parsedXML[$xmlField]=substr($xmlRaw,
        strpos($xmlRaw,"<$xmlField>")+strlen("<$xmlField>"),
        strpos($xmlRaw,"</$xmlField>")-strlen("<$xmlField>")
        -strpos($xmlRaw,"<$xmlField>"));
    }
}
print_r($parsedXML);
// prints: Array ( [order] => Order data [label] => Label data [control] => 123 )
?>