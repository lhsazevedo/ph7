<?
//Test the closure mechansim
class Operations{
    public function ops($x,$y,$op){
        switch ($op){
            case 'ADD':return function() use($x,$y){
                            return $x+$y."\n";                           
                       };
                       break;
            case 'SUB': return function() use ($x,$y){
                            return $x-$y."\n";                           
                        };
                        break;
            default:    return function(){
                            return "Operation is not supported by class"."\n";
                        };
        }           
    }
}

$op =  new Operations();
$fn1 = $op->ops(6,7,'ADD');
echo $fn1();

$fn2 = $op->ops(6,2,'SUB');
echo $fn2();

$fn2 = $op->ops(6,7,'MUL');
echo $fn2(); 
/*
 * Should output
13

4

Operation is not supported by class
*/

?>