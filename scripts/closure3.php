<?
//Test the closure mechansim
class House
{
     public function paint($color)
     {
         return function() use ($color) { echo "Painting the house $color....\n"; };
     }
}

$house = new House();
/* Note that we use COMMA expressions and direct function call here
 * which are PH7 extensions.
 * Refer to the official documentation for more information on these
 * powerfull extensions.
 */
$house->paint('red')()/* <-- Direct function call */,$house->paint('Blue')(),$house->paint('green')();
/*
 * Should output

Painting the house red....

Painting the house Blue....

Painting the house green....
*/
?>