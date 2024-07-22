<?
/*
 * Filter directory entry (Show only avi or mp3 files)
 */
 if( count($argv) > 0 && is_string($argv[0]) ){
  /* List the given path */
  $dir = $argv[0];
 }else{
  /* List the current working directory */
   $dir = getcwd();
  }
function scanDirectories($rootDir, $allowext, $allData=array()) {
    $dirContent = scandir($rootDir);
    foreach($dirContent as $key => $content) {
        $path = $rootDir.'/'.$content;
        $ext = substr($content, strrpos($content, '.') + 1);
       
        if(in_array($ext, $allowext)) {
            if(is_file($path) && is_readable($path)) {
                $allData[] = $path;
            }elseif(is_dir($path) && is_readable($path)) {
                // recursive callback to open new directory
                $allData = scanDirectories($path, $allData);
            }
        }
    }
    return $allData;
}

$allowext = array("avi","mp3"); //List only avi or mp3 files
$files_array = scanDirectories($dir,$allowext);
print_r($files_array);
?>