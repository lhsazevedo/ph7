<?
function center_text($word){
    $tot_width = 30;
    $symbol = "-";
    $middle = round($tot_width/2);
    $length_word = strlen($word);
    $middle_word = round($length_word / 2);
    $last_position = $middle + $middle_word;
    $number_of_spaces = $middle - $middle_word;

    $result = sprintf("%'{$symbol}{$last_position}s", $word);
        for ($i = 0; $i < $number_of_spaces; $i++){
            $result .= "$symbol";
        }
    return $result;
}

$string = "This is some text";
print center_text($string);
/* Should output
---------------This is some text------------
*/
?>