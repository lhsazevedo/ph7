<?
/* Simple anonymous function */
$func = function($name)
{
    echo "Hello $name\n";
};
 
$func("world!");
$func("Dean!");
 
/* Should output 
 Hello world!
 Hello Dean!
*/
?>