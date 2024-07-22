<?
/*
 * Complex expressions for function arguments default values.
 *
 * While the standard PHP engine would allow simple scalar values for function
 * arguments default values,PH7 goes further and let you use any complex expressions
 * including function calls,math or string expressions and so on as a default values
 * for your function arguments.
 *
 * Note that the first argument of the test() function takes an anonymous function! as it's default value.
 * Refer to: http://ph7.symisc.net/features.html#complex for a full discussion on this
 * extension.
 */
function test($a = (function($a,$b,$c){ return $a+$b+$c; })(14,10+2,15),$v = "Time: "./* Concat */__TIME__, $c = "Date: "./* Concat */__DATE__)
{
	echo $a.PHP_EOL;
	echo $v.PHP_EOL;
	echo $c.PHP_EOL;
}
test();
test(512);
test(1024,32);
test(1000,2000,4000); 

?>