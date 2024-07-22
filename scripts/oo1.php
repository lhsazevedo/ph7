<?
/*
 * Test the PH7 OO subsystem
 */
/*
When running,this example should output
-------------

Abraham the Cat goes meeoow!
Brad the Dog goes woof!
Celeste the Bird goes chirp chirp!!
Fido the Dog goes woof!
Jawbone the Dog goes woof!
Kiki the Bird goes chirp chirp!!
Pussy the Cat goes meeoow!
*/
//Example taken verbatim from PHP forums
abstract class Animal
{
  public $type;
  public $name;
  public $sound;

  /*
   * called by Dog, Cat, Bird, etc.
   */
  public function __construct($aType, $aName, $aSound)
  {
    $this->type = $aType;
    $this->name = $aName;
    $this->sound = $aSound;
  }

  /*
   * define the sorting rules - we will sort all Animals by name.
   */
  public static function compare($a, $b)
  {
    if($a->name < $b->name) return -1;
    else if($a->name == $b->name) return 0;
    else return 1;
  }

  /*
   * a String representation for all Animals.
   */
  public function __toString()
  {
    return "$this->name the $this->type goes $this->sound";
  }
}
class Dog extends Animal{
  public function __construct($name){
    parent::__construct("Dog", $name, "woof!");
  }
}

class Cat extends Animal{
  public function __construct($name){
    parent::__construct("Cat", $name, "meeoow!");
  }
}

class Bird extends Animal{
  public function __construct($name){
    parent::__construct("Bird", $name, "chirp chirp!!");
  }
}

# create a PHP Array and initialize it with Animal objects
$animals = array(
  new Dog("Fido"),
  new Bird("Celeste"),
  new Cat("Pussy"),
  new Dog("Brad"),
  new Bird("Kiki"),
  new Cat("Abraham"),
  new Dog("Jawbone")
);

# sort $animals with PHP's usort - calls Animal::compare() many many times.
usort($animals, array("Animal", "compare"));

# print out the sorted results - calls Animal->__toString().
foreach($animals as $animal) echo "$animal\n";
/*
When running,this example should output
-------------

Abraham the Cat goes meeoow!
Brad the Dog goes woof!
Celeste the Bird goes chirp chirp!!
Fido the Dog goes woof!
Jawbone the Dog goes woof!
Kiki the Bird goes chirp chirp!!
Pussy the Cat goes meeoow!
*/
?>