<?
//Anonymous function as event handler
class Event {

  public static $events = array();
 
  public static function bind($event, $callback, $obj = null) {
    if (!self::$events[$event]) {
      self::$events[$event] = array();
    }
   
    self::$events[$event][] = ($obj === null)  ? $callback : array($obj, $callback);
  }
 
  public static function run($event) {
    if (!self::$events[$event]) return;
   
    foreach (self::$events[$event] as $callback) {
      if (call_user_func($callback) === false) break;
    }
  }

}

function hello() {
  echo "Hello from function hello()\n";
}

class Foo {
  function hello() {
    echo "Hello from foo->hello()\n";
  }
}

class Bar {
  function hello() {
    echo "Hello from Bar::hello()\n";
  }
}

$foo = new Foo();

// bind a global function to the 'test' event
Event::bind("test", "hello");

// bind an anonymous function
Event::bind("test", function() { echo "Hello from anonymous function\n"; });

// bind an class function on an instance
Event::bind("test", "hello", $foo);


Event::run("test"); 
/*
 * Should output
Hello from function hello()
Hello from anonymous function
Hello from foo->hello()
*/
?>