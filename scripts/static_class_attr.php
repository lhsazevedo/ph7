<?
/* Static class attributes */
class A {
    function Z() {
        static $count = 0;       
        printf("%s: %d\n", get_class($this), ++$count);
    }
}
class B extends A {}
$a = new A();
$b = new B();
$a->Z();
$a->Z();
$b->Z();
$a->Z();
/* 
 * Should output
 
A: 1
A: 2
B: 3
A: 4
*/
?>