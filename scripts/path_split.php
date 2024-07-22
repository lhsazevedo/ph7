<?
/* Split a path to it's components */
function parsePathComponents($path,$endSlash=true,$base=false)
{
 for(
     $path = trim($path),
     $slash = strstr(PHP_OS,'WIN') ? '\/' : '/',
     $retArray = array(),
     $str = $temp = "",
     $x = 0;
 $char = @$path[$x]; $x++)
 {
  if(!strstr($slash,$char)) $temp .= $char;
  elseif($temp){
       $str .= $temp;
       $retArray[$temp] = $str.($endSlash ? $slash[0] : '');
       $str .= $slash[0];
       $temp = "";
  }
 }
 $base&&$temp and $retArray[$temp] = $str.$temp;
 return $retArray;
}

// Testing in WINDOWS
// NOTE: UNIX will return paths with normal slashes

// return array with path names ending with a slash
$path = '/my//stupid//path/to///some/file.php';
$pathComps = parsePathComponents($path);
print_r($pathComps);

//Array ( [my] => my\ [stupid] => my\stupid\ [path] => my\stupid\path\ [to] => my\stupid\path\to\ [some] => my\stupid\path\to\some\ )

$path = 'my/other//path/';
// return paths not ending with slash
print_r(parsePathComponents($path,false));
// Array ( [my] => my [other] => my\other [path] => my\other\path )

$path = 'my//other/path/to///file.php';
// use third argument = true: for capturing the "file.php" base
print_r(parsePathComponents($path,true,true));
?>