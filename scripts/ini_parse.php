<?
/* Parse INI chunk */
$ini = <<<INI
; This is a sample configuration file
; Comments start with ';', as in php.ini

[first_section]
shell = zsh
PC = Symisc-box/FreeBSD
USER = DEAN

[second_section]
path = "/usr/local/bin"
URL = "http://www.example.com/~username"

[third_section]
CIN[] = "First"
CIN[] = "Second"
CIN[] = 'Third'
CIN[] = Fourth
INI;

var_dump(parse_ini_string($ini,TRUE));
/* You caoul use also parse_ini_file() */
/*
 * Should output

array(3) {
 [first_section] =>
  array(3) {
   [shell] =>
    string(3 'zsh')
   [PC] =>
    string(18 'Symisc-box/FreeBSD')
   [USER] =>
    string(4 'DEAN')
   }
 [second_section] =>
  array(2) {
   [path] =>
    string(14 '/usr/local/bin')
   [URL] =>
    string(32 'http://www.example.com/~username')
   }
 [third_section] =>
  array(1) {
   [CIN] =>
    array(4) {
     [0] =>
      string(5 'First')
     [1] =>
      string(6 'Second')
     [2] =>
      string(5 'Third')
     [3] =>
      string(6 'Fourth')
     }
   }
 }
 */
?>