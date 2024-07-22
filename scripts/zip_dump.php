<?
//Dump ZIP archive
if( count($argv) < 1 ){
 die("{$_SERVER['SCRIPT_FILENAME']}: Missing path to ZIP archive\n");
}
$zip = zip_open($argv[0]);

if ($zip) {
    while ($zip_entry = zip_read($zip)) {
	
        echo "Name:               " . zip_entry_name($zip_entry) . "\n";
        echo "Actual Filesize:    " . zip_entry_filesize($zip_entry) . "\n";
        echo "Compressed Size:    " . zip_entry_compressedsize($zip_entry) . "\n";
        echo "Compression Method: " . zip_entry_compressionmethod($zip_entry) . "\n";

        if (zip_entry_open($zip, $zip_entry, "r")) {
            echo "File Contents:\n";
			if( zip_entry_filesize($zip_entry) < 1 ){
				echo "Directory";
			}else if( zip_entry_compressionmethod($zip_entry) != 'stored' ){
				echo "Binary Data";
			}else{
			  /* Safely read the data */
			  $buf = zip_entry_read($zip_entry, /*zip_entry_filesize($zip_entry)*/50);
			  echo "------First 50 bytes---------\n$buf\n";
			}
          
            zip_entry_close($zip_entry);
        }
        echo "\n";
    }
	zip_close($zip);
}else{
	die( "Not a ZIP archive - Please specify a valid path to a ZIP archive\n");
}
?>