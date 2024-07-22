<?
/* 
 * The script returns the tree-structure of an XML document in a single array. 
 */
$stack = array();

function startTag($parser, $name, $attrs)
{
   global $stack;
   $tag=array("name"=>$name,"attrs"=>$attrs);  
   array_push($stack,$tag);
 
}

function cdata($parser, $cdata)
{
    global $stack,$i;
   
    if(trim($cdata))
    {    
        $stack[count($stack)-1]['cdata']=$cdata;   
    }
}

function endTag($parser, $name)
{
   global $stack;  
   $stack[count($stack)-2]['children'][] = $stack[count($stack)-1];
   array_pop($stack);
}

$xml_parser = xml_parser_create();
xml_set_element_handler($xml_parser, "startTag", "endTag");
xml_set_character_data_handler($xml_parser, "cdata");

$data = xml_parse($xml_parser,<<<XML
<?xml version='1.0'?>
<chapter>
  <TITLE>Title &plainEntity;</TITLE>
  <para>
    <informaltable>
      <tgroup cols="3">
        <tbody>
          <row>
            <entry>a1</entry>
            <entry morerows="1">b1</entry>
            <entry>c1</entry>
          </row>
          <row>
            <entry>a2</entry>
            <entry>c2</entry>
          </row>
          <row>
            <entry>a3</entry>
            <entry>b3</entry>
            <entry>c3</entry>
          </row>
        </tbody>
      </tgroup>
    </informaltable>
  </para>
  &systemEntity;
  <section id="about">
    <title>About this Document</title>
    <para>
      <!-- this is a comment -->
      <?php echo 'Hi!  This is PH7 version ' . ph7version().PHP_EOL; ?>
    </para>
  </section>
</chapter>
XML
);
if(!$data) {
   die(sprintf("XML error: %s at line %d",
xml_error_string(xml_get_error_code($xml_parser)),
xml_get_current_line_number($xml_parser)));
}

xml_parser_free($xml_parser);

print_r($stack);
?>