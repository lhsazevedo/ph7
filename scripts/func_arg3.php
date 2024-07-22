<?
/*
 * Complex expressions for function arguments default values.
 *
 * While the standard PHP engine would allow simple scalar values for function
 * arguments default values,PH7 goes further and let you use any complex expressions
 * including function calls,math or string expressions and so on as a default values
 * for your function arguments.
 *
 * Refer to: http://ph7.symisc.net/features.html#complex for a full discussion on this
 * extension.
 */
 /* Anonymous function as a default value! */
function test($callback = function(){ echo "Hello World!\n";})
{
 /* Check if we are dealing with a callback */
if( !is_callable($callback) ){
 die("Expecting a callback");
}
/* Invoke the callback */
$callback();
}
/* Call without arguments */
test(); /* You should see: Hello World */
/* Call with a single argument */
test(function(){ echo "Welcome guest";}); /* You should see: Welcome guest */

?>