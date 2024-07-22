<?
/* Test the callback mechanism */
function my_function(callable $x)
{
    return $x();
}
 
function my_callback_function(){return 'Hello Nettuts!'.PHP_EOL;}
 
class Hello{static function hi(){return 'Hello Nettuts!'.PHP_EOL;}}
class Hi{function hello(){return 'Hello Nettuts!'.PHP_EOL;}}
 
echo my_function(function(){return 'Hello Nettuts!'.PHP_EOL;}); // anonymous function
echo my_function('my_callback_function'); // callback function
echo my_function(array('Hello', 'hi')); // class name, static method
echo my_function(array((new Hi), 'hello')); // class object, method name
//Invoke method
class Dog
{
    public function __invoke()
    {
         echo "I am a dog!";
    }
}

$dog = new Dog();
$dog();

/*
 Should output
Hello Nettuts
Hello Nettuts
Hello Nettuts
Hello Nettuts
I am a dog!
*/
?>