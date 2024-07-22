<?
/* Test the powerful overloading mechanism with class methods introduced by the PH7 engine
 * Refer to http://ph7.symisc.net/features.html#overloading for additional information.
 */
class a {
   public static function foo($a) {
     return $a.PHP_EOL;
  }
  static function foo($a, $b) {
     return $a + $b;
  }
}
$c = new a();
echo $c->foo(rand()&1023); //print a random number
echo $c->foo(25,50); //print 75
?>