<?
/* Test the powerful overloading mechanism introduced by the PH7 engine
 * Refer to http://ph7.symisc.net/features.html#overloading for additional information.
 */
 function foo($a) {
    //foo() accepts only a single argument
   return $a.PHP_EOL;
}
function foo($a, $b) {
   // foo() accepts two arguments and perform their addition.

     return $a + $b;

}

echo foo(5); // Prints "5"

echo foo(10, 2); // Prints "12"

?>