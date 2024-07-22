<?
//Built-in XML parser with namespace support
$depth = array();

    // entire script here
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
/* Create the XML engine with namespace support */
$xml_parser = xml_parser_create_ns();
/* Element handler */
xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "characterData");
/* Namespace handler */
xml_set_start_namespace_decl_handler($xml_parser,
	function($parser,$prefix,$uri){ /* Annonymous functions */
		echo "Name space start\n";
		var_dump($prefix,$uri);
	}
);
xml_set_end_namespace_decl_handler($xml_parser,
	function($parser,$prefix){   /* Annonymous functions */
		echo "Name space end\n";
		var_dump($prefix);
	}
);
/* Some XML to test*/
$zBuf = <<<XML
<?xml version="1.0" encoding="ISO-8859-1" ?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
<html>
<body>
  <h2>My CD Collection</h2>
  <table border="1">
    <tr>
      <th align="left">Title</th>
      <th align="left">Artist</th>
    </tr>
    <xsl:for-each select="catalog/cd">
    <tr>
      <td><xsl:value-of select="title"/></td>
      <td><xsl:value-of select="artist"/></td>
    </tr>
    </xsl:for-each>
  </table>
</body>
</html>
</xsl:template>

</xsl:stylesheet>
XML;

if (!xml_parse($xml_parser, /*file_get_contents("xm.txt")*/$zBuf)) {
        die(sprintf("XML error: %s at line %d",
                    xml_error_string(xml_get_error_code($xml_parser)),
                    xml_get_current_line_number($xml_parser)));
  }
 
 xml_parser_free($xml_parse);
 /*
  Should Output
  Name space start
string(3 'xsl')
string(36 'http://www.w3.org/1999/XSL/Transform')
http://www.w3.org/1999/XSL/Transform:stylesheet 
version ==> 1.0
    http://www.w3.org/1999/XSL/Transform:template 
    match ==> /
        html
            body
                h2
                    My CD Collection
                h2
                table
                border ==> 1
                    tr
                        th
                        align ==> left
                            Title
                        th
                        th
                        align ==> left
                            Artist
                        th
                    tr
                    http://www.w3.org/1999/XSL/Transform:for-each 
                    select ==> catalog/cd
                        tr
                            td
                                http://www.w3.org/1999/XSL/Transform:value-of 
                                select ==> title
                                http://www.w3.org/1999/XSL/Transform:value-of 
                            td
                            td
                                http://www.w3.org/1999/XSL/Transform:value-of 
                                select ==> artist
                                http://www.w3.org/1999/XSL/Transform:value-of 
                            td
                        tr
                    http://www.w3.org/1999/XSL/Transform:for-each>
                table
            body
        html
    http://www.w3.org/1999/XSL/Transform:template>
http://www.w3.org/1999/XSL/Transform:stylesheet>
Name space end
string(3 'xsl')
  */
?>