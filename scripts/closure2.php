<?
//Test the closure mechansim
class Dog
{
    public $_name; /* Must be public so the closure body can access it*/
    public $_color;/* Must be public so the closure body can access it*/

    public function __construct($name, $color)
    {
         $this->_name = $name;
         $this->_color = $color;
    }

    public function greet($greeting)
    {
		
         return function() use ($greeting) {

             echo "$greeting, I am a {$this->_color} dog named {$this->_name}\n";
         };
    }
}

$dog = new Dog("Alex","red");
$c = $dog->greet("Hello");
$c();
/*
 * Should output
Hello, I am a red dog named Alex
*/
?>