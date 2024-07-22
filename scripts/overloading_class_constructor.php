<?
/* Test the powerful overloading mechanism with class constructor introduced by the PH7 engine
 * Refer to http://ph7.symisc.net/features.html#overloading for additional information.
 */
class a {
  function __construct($a) {
    echo $a.PHP_EOL;
 }
  function __construct($a, $b) {
    echo $a + $b;
  }
}
$c = new a(150); /* You should see: 150 */
$c = new a(60,200); /* You should see: 260 */
?>