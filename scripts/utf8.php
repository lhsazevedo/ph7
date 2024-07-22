<?
$概要 = "PH7 engine";
$文書 = "http://ph7.symisc.net";
function ダウンロード(){
  echo "http://ph7.symisc.net/downloads.html".PHP_EOL;
}
/* Test */
var_dump($概要,$文書);
/* Call the download function */
ダウンロード();
function is_utf8($str) {
    $c=0; $b=0;
    $bits=0;
    $len=strlen($str);
    for($i=0; $i<$len; $i++){
        $c=ord($str[$i]);
        if ($c >= 128) {
            if(($c >= 254)) return false;
            elseif($c >= 252) $bits=6;
            elseif($c >= 248) $bits=5;
            elseif($c >= 240) $bits=4;
            elseif($c >= 224) $bits=3;
            elseif($c >= 192) $bits=2;
            else return false;
            if(($i+$bits) > $len) return false;
            while($bits > 1){
                $i++;
                $b=ord($str[$i]);
                if($b < 128 || $b > 191) return false;
                $bits--;
            }
        }
    }
    return true;
}
var_dump(is_utf8('hello'),is_utf8("すが、基本的な使い方は単純です。かしながら使い方を身につけていきましょう"));
?>