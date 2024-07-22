<?
/*
 * Extract ID3v1 tags of all MP3s of the given directory.
 * When running,you should see something like that

MP3: FLOSS-026.mp3 23.4 MB
Title: FLOSS Weekly 26: SQLite
Artist: Randal Schwartz and Leo Laport
Album: FLOSS Weekly March 2008
Year: 2008
------------------------------------------------------
MP3: FLOSS-058.mp3 34.0 MB
Title: FLOSS Weekly 58: ZFS
Artist: Randal Schwartz and Leo Laport
Album: FLOSS Weekly February 2009
Year: 2009

 */
if( count($argv) < 1 ){
 die("{$_SERVER['SCRIPT_FILENAME']}: Missing Path to MP3s");
}
$dir = $argv[0];
if( !chdir($dir) ){
	die("Error while changing directory");
}
/* Collect MP3 files */
$pFiles = glob("*.mp3");
if( is_array($pFiles) ){
  foreach($pFiles as $pEntry){
     echo "\nMP3: $pEntry ",size_format(filesize($pEntry)),PHP_EOL;/* Give a nice presentation */
	 /* Open the file in a read*only mode */
	 $pHandle = fopen($pEntry,'r');
	 if( $pHandle == FALSE ){
	   echo "IO error while opening $pEntry\n";
	   continue; /* Ignore */
	 }
	 /* Seek 128 bytes from the end */
	 fseek($pHandle,-128,SEEK_END);
	 /* Read the 128 raw data */
	 $zBuf = fread($pHandle,128);
	 if( !$zBuf || strlen($zBuf) != 128 ){
		echo "$pEntry: Read error\n";
		/* Ignore */
		continue;
	 }
	 if( $zBuf[0] == 'T' && $zBuf[1] == 'A' && $zBuf[2] == 'G'  ){
	    $nOfft = 3 /* TAG */;
		/* Extract the title */
		$zTitle = substr($zBuf,$nOfft,30);
		/* Remove trailing and leading NUL bytes and white spaces */
		$zTitle = trim($zTitle);
		if( strlen($zTitle) > 0 ){
				echo "Title: $zTitle\n";
		}
		/* Extract artist name */
		$zArtist = substr($zBuf,$nOfft+30,30);
		/* Remove trailing and leading NUL bytes and white spaces */
		$zArtist = trim($zArtist);
		if( strlen($zArtist) > 0 ){
				echo "Artist: $zArtist\n";
		}
		/* Extract album name */
		$zAlbum = substr($zBuf,$nOfft+30+30,30);
		/* Remove trailing and leading NUL bytes and white spaces */
		$zAlbum = trim($zAlbum);
		if( strlen($zAlbum) > 0 ){
				echo "Album: $zAlbum\n";
		}
		/* Extract the Year */
		$zYear = substr($zBuf,$nOfft+30+30+30,4);
		/* Remove trailing and leading NUL bytes and white spaces */
		$zYear = trim($zYear);
		if( strlen($zYear) > 0 ){
				echo "Year: $zYear\n";
		}
		/* Next entry */
		echo "------------------------------------------------------\n";
	 }
	 /* All done whith this file,close the handle */
	 fclose($pHandle);
  }
}
?>