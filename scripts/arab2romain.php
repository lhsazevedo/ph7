<?
/*
 * Arab number to roman number
 */
  function num2Roman($num) 
 {
     // Make sure that we only use the integer portion of the value
     $n = intval($num);
     $result = '';
 
     // Declare a lookup array that we will use to traverse the number:
     $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
     'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
     'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
 
     foreach ($lookup as $roman => $value) 
     {
         // Determine the number of matches
         $matches = intval($n / $value);
 
         // Store that many characters
         $result .= str_repeat($roman, $matches);
 
         // Substract that from the number
         $n = $n % $value;
     }
 
     // The Roman numeral should be built, return it
     return $result;
 }
 echo "Arab numbers to roman numbers\n";
 echo "1985 ==> ",num2Roman(1985).PHP_EOL;
 echo "1999 ==> ",num2Roman(1999).PHP_EOL;
 echo "2012 ==> ",num2Roman(2012).PHP_EOL;
 if( count($argv) > 0 && is_numeric($argv[0]) ){
  /* Test with the given number */
  echo "$argv[0] ==> ",num2Roman($argv[0]).PHP_EOL;
 }
?>