<?
/* Test the goto statement */
$i = 0;
a:
echo 'Bar'.PHP_EOL;
if( $i > 5 ):
	goto Out;
endif
$i++;
goto a;
Out:
echo 'Foo';
/*
 Should output
Bar
Bar
Bar
Bar
Bar
Bar
Bar
Foo
*/
function a(int $a = 3+2+1){
	switch($a){
		case 1:
			echo "\$a is 1\n";
			goto __Out;
		case 2:
			echo "\$a is 2\n";
			goto __Out;
		default:
			echo "nope\n";
			goto __Out;
	}
__Out:
	echo "End switch..exiting\n";
	return;
}
a(1+1);
/*
 Should output
 $a is 2
 End switch..exiting
*/

$link = true;

    if ( $link ) goto iw_link_begin;
    if(false) iw__link_begin:
   
    if ( $link ) goto iw_link_text;
    if(false) iw__link_text:
   
    if ( $link ) goto iw_link_end;
    if(false) iw__link_end:
   
    goto iw_end_gt;
   
   
    if (false) iw_link_begin:
        echo '<a href="#">';
    goto iw__link_begin;
   
    if (false) iw_link_text:
        echo 'Sample Text';
    goto iw__link_text;
   
    if (false) iw_link_end:
        echo '</a>';
    goto iw__link_end;
   
    iw_end_gt:
/*
 Should output
 <a href="#'>Sample Text</a>
*/
$headers = Array('subject', 'bcc', 'to', 'cc', 'date', 'sender');
$position = 0;

hIterator: {

    $c = 0;
    echo $headers[$position] . PHP_EOL;

    cIterator: {
        echo ' ' . $headers[$position][$c] . PHP_EOL;

        if(!isset($headers[$position][++$c])) {
            goto cIteratorExit;
        }
        goto cIterator;
    }

    cIteratorExit: {
        if(isset($headers[++$position])) {
            goto hIterator;
        }
    }
} 
/*
 * Should output
subject
 s
 u
 b
 j
 e
 c
 t
bcc
 b
 c
 c
to
 t
 o
cc
 c
 c
date
 d
 a
 t
 e
sender
 s
 e
 n
 d
 e
 r
 */
?>