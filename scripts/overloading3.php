<?
/* Test the powerful overloading mechanism introduced by the PH7 engine
 * Refer to http://ph7.symisc.net/features.html#overloading for additional information.
 */
 //Wikipedia example

// volume of a cube
function volume(int $s)
{
  return $s*$s*$s;
}
// volume of a cylinder
function volume(float $r,int $h)
{
  return 3.14*$r*$r*$h;
}
// volume of a cuboid
function volume(float $l,int $b,int $h)
{
  return $l*$b*$h;
}
/* Test the overloading mechanism */
echo volume(10).PHP_EOL; /* You should see 1000 */
echo volume(2.5,8).PHP_EOL; /* You should see 157 */
echo volume(100,75,15); /* You should see 112500 */
?>