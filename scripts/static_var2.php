<?
/* Static variable test */
function a(){
  static $myVar = "Welcome "." guest ";
  var_dump($myVar); 
  $myVar.=rand_str(3);
 }
 a(),a(),a(),a();a(),a(),a(); //Comma expressions extension: http://ph7.symisc.net/features.html#comma
/*
 * Should output (Welcome  guest + Random string) as follows

string(15 'Welcome  guest ')
string(18 'Welcome  guest qij')
string(21 'Welcome  guest qijxew')
string(24 'Welcome  guest qijxewfhn')
string(27 'Welcome  guest qijxewfhnpas')
string(30 'Welcome  guest qijxewfhnpasmoc')
string(33 'Welcome  guest qijxewfhnpasmockgj')
*/
?>