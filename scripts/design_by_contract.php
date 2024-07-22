<?
//Here is a simple demonstration of Design By Contract with PH7
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_BAIL, 1);
assert_options(ASSERT_CALLBACK, 'dcb_callback');

function dcb_callback($script, $line, $message) {
    echo "<h1>Condition failed!</h1><br />
        Script: <strong>$script</strong><br />
        Line: <strong>$line</strong><br />
        Condition: <br /><pre>$message</pre>";
}

// Parameters
$a = 7;
$b = 'Simple DCB with PH';

// Pre-Condition
assert('
    is_integer($a) &&
    ($a > 0) &&
    ($a < 20) &&
   
    is_string($b) &&
    (strlen($b) > 5);
');

// Function
function combine($a, $b) {
    return "Kombined: " . $b . $a;
}

$result = combine($a, $b);

// Post-Condition
assert('
    is_string($result) &&
    (strlen($result) > 0);
');

// All right, the Function works fine
var_dump($result);
/*
 Should output
string(29 'Kombined: Simple DCB with PH7')
*/
?>