<?
//Test the str_replace() function
function data_template($input, $template) {
  if ($template) { // template string
    if ($split = str_split($template)) { // each char as array member
      foreach ($split as $char) { // each character
        if (is_numeric($char)) { // test for digit
          if ($s != 1) { // new digit sequence
            $i++;
            $s = 1;
          }
          $digits[$i] .= $char; // store digit
        } else { // not a digit
          if ($s != 2) { // new non-digit sequence
            $i++;
            $s = 2;
          }
          $strings[$i] .= $char; // store string
        }
      }
      if ($i && $input && is_array($input)) { // input data
        foreach ($input as $sub) { // each subarray
          if (is_array($sub)) {
            $out = ''; // reset output
            for ($j = 0; $j <= $i; $j++) { // each number/string member
              if ($number = $digits[$j]) { // number
                $out .= $sub[$number]; // add value from subarray to output
              } else { // string
                $out .= $strings[$j]; // add to output
              }
            }
            $a[] = $out;
          }
        }
        return $a;
      } // input
    } // split
  } // template
}

$input = array(array(1=>'yellow', 2=>'banana', 11=>'fruit'), array(1=>'green', 2=>'spinach', 11=>'vegetable'), array(1=>'pink', 2=>'salmon', 11=>'fish'));

print_r (data_template($input, '2: a 1, healthy 11')); 
/*
 * Should output
Array[3] ={

    [0] => banana: a yellow, healthy fruit
    [1] => spinach: a green, healthy vegetable
    [2] => salmon: a pink, healthy fish
} 
*/
?>