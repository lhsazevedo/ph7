<?
//Anonymous function as a filter callback - Found somewhere in the web
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
 
/* An array of random numbers */
$randomNumbers = array(34, 56, 22, 1, 5, 67, 897, 123, 4, 55);
 
$condition = function($x) 
{ 
    return ($x > 100) ? true : false; 
};
 
$greaterThan100 = filter($condition, $randomNumbers);
 
 
print_r($greaterThan100);
/*
 * Should output

Array ( [0] => 897 [1] => 123 ) 
*/
?>