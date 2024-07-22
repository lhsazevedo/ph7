<?
/* Test the type juggling mechanism */
$foo = "0";  // $foo is string (ASCII 48)
var_dump($foo);
$foo += 2;   // $foo is now an integer (2)
var_dump($foo);
$foo = $foo + 1.3;  // $foo is now a float (3.3)
var_dump($foo);
$foo = 5 + "10 Little Piggies"; // $foo is integer (15)
var_dump($foo);
$foo = 5 + "10 Small Pigs";     // $foo is integer (15)
var_dump($foo);
$a    = 'car'; // $a is a string
$a[0] = 'b';   // $a is still a string
var_dump( $a );       // bar
$foo = 10;   // $foo is an integer
$bar = (boolean) $foo;   // $bar is a boolean
var_dump($bar);
/*
 * Should output
string(1 '0')
int(2)
float(3.3)
int(15)
int(15)
string(3 'bar')
bool(TRUE)
*/
?>