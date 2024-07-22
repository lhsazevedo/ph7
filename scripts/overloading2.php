<?
/* Test the powerful overloading mechanism introduced by the PH7 engine
 * Refer to http://ph7.symisc.net/features.html#overloading for additional information.
 * Test with the full type hinting extensions
 * Refer to http://ph7.symisc.net/features.html#full_type_hinting for additional information.
 */
function foo(string $a)
{
  echo "a is a string\n";
  var_dump($a);
}

function foo(int $a)
{
  echo "a is integer\n";
  var_dump($a);
}

function foo(array $a)
{
  echo "a is an array\n";
  var_dump($a);
}

/* Test the mechanism */
foo('This is a great feature'); /* a is a string (first foo) */
foo(52); /* a is integer (second foo) */
foo(array(14,__TIME__,__DATE__)); /* a is an array (third foo) */
?>