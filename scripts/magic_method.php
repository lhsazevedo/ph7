<?
//Test the '__invoke()' magic method
class Dog
{
    public function __invoke()
    {
         echo "I am a dog!\n";
    }
}

$dog = new Dog();
$dog();
/*
 * Should output

 I am a dog!
 */
?>