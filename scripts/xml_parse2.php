<?
////////////////////////////////////////XML parser with a class instance///////////////////////////////
class xml  {
    var $parser;

    function xml() 
    {
        $this->parser = xml_parser_create();

        xml_set_element_handler($this->parser, array($this,"tag_open"), array($this,"tag_close"));
        xml_set_character_data_handler($this->parser, array($this,"cdata"));
    }
    function parse($data) 
    {
        xml_parse($this->parser, $data);
    }

    function tag_open($parser, $tag, $attributes) 
    {
        var_dump($tag, $attributes); 
    }

    function cdata($parser, $cdata) 
    {
        var_dump( $cdata);
    }

    function tag_close($parser, $tag) 
    {
        var_dump( $tag);
    }

} // end of class xml

$xml_parser = new xml();
$xml_parser->parse("<Tag ID='hallo' width='65' height='170'>Welcome guest</Tag>");
xml_parser_free($xml_parser->parser);
unset($xml_parser);
/*
 * Should output
string(3 'Tag')
array(3) {
 [ID] =>
  string(5 'hallo')
 [width] =>
  string(2 '65')
 [height] =>
  string(3 '170')
 }
string(13 'Welcome guest')
string(3 'Tag')
*/
?>