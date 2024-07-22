<?
$a = array('<foo>',"'bar'",'"baz"','&blong&', "\xc3\xa9");

echo "Normal: ",  json_encode($a), "\n";
echo "Tags: ",    json_encode($a, JSON_HEX_TAG), "\n";
echo "Apos: ",    json_encode($a, JSON_HEX_APOS), "\n";
echo "Quot: ",    json_encode($a, JSON_HEX_QUOT), "\n";
echo "Amp: ",     json_encode($a, JSON_HEX_AMP), "\n";
echo "All: ",     json_encode($a, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP ), "\n\n";

$b = array();

echo "Empty array output as array: ", json_encode($b), "\n";
echo "Empty array output as object: ", json_encode($b, JSON_FORCE_OBJECT), "\n\n";

$c = array(array(1,2,3));

echo "Non-associative array output as array: ", json_encode($c), "\n";
echo "Non-associative array output as object: ", json_encode($c, JSON_FORCE_OBJECT), "\n\n";

$d = array('foo' => 'bar', 'baz' => 'long');

echo "Associative array always output as array: ", json_encode($d), "\n";
echo "Associative array output as object: ", json_encode($d, JSON_FORCE_OBJECT), "\n\n";
/* Object encoding */
class MyClass{
 var $a = 25<<1+10;
 public $b = rand_str(3); /* Random string of length 3*/
 public $c = rand() & 1023; /* Random value */
 const CONST = 14*2;
 private static $xmen = "X-"."MEN";
}
echo "Class 'MyClass' as:\n\t",json_encode(new MyClass());
/*
 * This should output

Normal: ["<foo>","'bar'","\"baz\"","&blong&","é"]
Tags: ["\u003Cfoo\u003E","'bar'","\"baz\"","&blong&","é"]
Apos: ["<foo>","\u0027bar\u0027","\"baz\"","&blong&","é"]
Quot: ["<foo>","'bar'","\u0022baz\u0022","&blong&","é"]
Amp: ["<foo>","'bar'","\"baz\"","\u0026blong\u0026","é"]
All: ["\u003Cfoo\u003E","\u0027bar\u0027","\u0022baz\u0022","\u0026blong\u0026","é"]

Empty array output as array: []
Empty array output as object: {}

Non-associative array output as array: [[1,2,3]]
Non-associative array output as object: {"0":{"0":1,"1":2,"2":3}}

Associative array always output as array: ["bar","long"]
Associative array output as object: {"foo":"bar","baz":"long"}

Class 'MyClass' as:
	{"a":51200,"b":"vjm","c":431,"CONST":28,"xmen":"X-MEN"}
	*/
?>