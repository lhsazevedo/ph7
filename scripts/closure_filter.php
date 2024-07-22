<?
//Closure as a filter callback - Found somewhere in the web
/*
Lets say we want to filter an array of number according to a certain criteria; say all the numbers above 100. The code for the same is given below. Note the use of a anonymous function.
*/
function filter($condition, $numbers) 
{
    $len = count($numbers);
    $filtered = array();
 
    /* Iterate through all the array elements */
    for($i = 0; $i < $len; $i++) 
    {
        $num = $numbers[$i];
 
        /* If the number satisfies the $condition, store
           it in the $filtered array
        */
        if($condition($num)) {
            $filtered[] = $num;
        }
    }
    return $filtered;
}
 
 
/* createFilter now returns a anonymous function */
function createFilter($lowerBound)
{
    return function($x) use ($lowerBound)
    {
        return ($x > $lowerBound) ? true : false;
    };
}
 
 
/* An array of random numbers */
$randomNumbers = array(34, 56, 22, 1, 5, 67, 897, 123, 4, 55);
 
/* Create a new function and store it in $greaterThan400 */
$greaterThan400 = createFilter(400);
$greaterThan100 = createFilter(100);
 
print_r(filter($greaterThan400, $randomNumbers));
print_r(filter($greaterThan100, $randomNumbers));
 
// Output
// Array ( [0] => 897 ) 
// Array ( [0] => 897 [1] => 123 )
?>