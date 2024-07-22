<?
/* Test the full type hinting extension introduced by the PH7 engine
 * Refer to http://ph7.symisc.net/features.html#full_type_hinting for additional information.
 */
function test(string $a)
{
 var_dump($a);
}
/* Call with a string argument */
test("Hello world"); //Output string(11 'Hello world');
/* Call with an int argument */
test(0xFFFFFFFF); //Output string(10 '4294967295');
/* Call with a float argument */
test(25.e-1); //Output string(3 '2.5');
function test2(int $a)
{
 var_dump($a);
}
/* Call with a string argument */
test2(" 256garbage"); //Output int(256);
/* Call with a float argument */
test2(14.52e+2); //Output int(1452)
?>