<?
/*
 * Perform a directory listing on the given path
 * or the current working directory if no given arguments.
 */
 if( count($argv) > 0 && is_string($argv[0]) ){
  /* List the given path */
  $dir = $argv[0];
 }else{
  /* List the current working directory */
   $dir = getcwd();
  }
if ($handle = opendir($dir) ) {
    echo "Directory handle: $handle\n";
    echo "Files:\n";

    while (false !== ($file = readdir($handle))) {
        echo "$file  :".size_format(filesize($dir.'/'.$file)).PHP_EOL;
    }

    closedir($handle);
}else{
 die("Cannot list: $dir\n");
}
?>