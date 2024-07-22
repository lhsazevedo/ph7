<?
/////////////////////////Object and reference///////////////////////
class A {
  protected $foo = 1;

  public function getFoo() {
    return $this->foo;
  }

  public function setFoo($val) {
    if($val > 0 && $val < 10) {
      $this->foo = $val;
    }
  }

  public function __toString() {
    return "A [foo=$this->foo]";
  }
}

$a = new A();
$b = $a;                        // $a and $b are copies of the same identifier
                                // ($a) = ($b) = <id>
$b->setFoo(2);
echo $a->getFoo() . PHP_EOL;

$c = new A();
$d = &$c;                       // $c and $d are references
                                // ($c,$d) = <id>
$d->setFoo(2);
echo $c . PHP_EOL;

$e = new A();
$e->setFoo(16);                 // will be ignored
echo $e;
/*
 * Should Output
 2
 A [foo=2]
 A [foo=1]
*/
?>