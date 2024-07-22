<?
//Test the closure mechansim
function paint($color)
     {
         return function() use ($color) { echo "Painting the house $color...\n"; };
     }
$c = paint("red");
$d = paint("Black");
$c();
$d();
/*
 * Should output

Painting the house red...
Painting the house Black...
*/
?>