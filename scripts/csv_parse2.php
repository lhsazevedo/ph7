<?
/* Parse CSV */
function outputCSV($data) {
    $outstream = fopen("php://output", 'w');
    array_walk(
	$data,
	function (&$vals, $key, $filehandler) {   /* Annonymous function */
           fputcsv($filehandler, $vals, ';', '"');
     },
    $outstream
    );
    fclose($outstream);
}

$mydata = array(
 array('data11', 'data12', 'data13'),
 array('data21', 'data22', 'data23'),
 array('data31', 'data32', 'data23'));

outputCSV($mydata);
/* Should Output

 data11;data12;data13
 data21;data22;data23
 data31;data32;data23
*/
?>