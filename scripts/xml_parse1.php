<?
$depth = array();
function startElement($parser, $name, $attrs) 
{
    global $depth;
    for ($i = 0; $i < $depth[$parser]; $i++) {
        echo "  ";
    }
    echo $name.PHP_EOL;
	foreach( $attrs as $key=>$value){
		for ($i = 0; $i < $depth[$parser]; $i++) {
		   echo "  ";
		}
		echo "$key ==> $value\n";
	} 
    $depth[$parser] += 2;
}

function endElement($parser, $name) 
{
    global $depth;
	$depth[$parser] -= 2;
	for ($i = 0; $i < $depth[$parser]; $i++) {
        echo "  ";
    }
	echo $name.PHP_EOL;
   
}

function characterData($parser, $data) 
{
   global $depth;
   for ($i = 0; $i < $depth[$parser]; $i++) {
        echo "  ";
    }
    echo $data.PHP_EOL;
}


$xml_parser = xml_parser_create();
xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "characterData");

$zBuf = <<<XML
<?xml version="1.0"?>
<note>
<to date="2012-08-03 03:52">Tony Montana</to>
<from>Jani</from>
<heading>Reminder</heading>
<body>Don't forget me this weekend</body>
</note> 
XML;

if (!xml_parse($xml_parser, /*file_get_contents("xm.txt")*/$zBuf)) {
        die(sprintf("XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($xml_parser)),
                    xml_get_current_line_number($xml_parser)));
  }
 
 xml_parser_free($xml_parse);
/*
 * Should output
note
    to
    date ==> 201-08-03 03:47
        Tony Montana
    to
    from
        Jani
    from
    heading
        Reminder
    heading
    body
        Don't forget me this weekend
    body
note
*/
?>