<?
//Test the built-in debug_backtrace() function
function a($p) {
    $backtrace = debug_backtrace();
   
    if (isset($backtrace['args']))
        var_export($backtrace['args']);
    else
        echo "Cannot aquire arguments\n";
   
    return $p;
}

function b($p1, $p2, $p3) {
    echo "$p1, $p2, $p3";
}
b(a("First a"), a("Second a"), a("Third a"));
/*
 * This will output

 [0] =>
  First a
 }
Array(1) {
 [0] =>
  Second a
 }
Array(1) {
 [0] =>
  Third a
 }
First a, Second a, Third a
*/
?>