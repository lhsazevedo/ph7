<?
/* Test the callback mechansim */
// An example callback function
function my_callback_function() {
    echo 'hello world!'.PHP_EOL;
}

// An example callback method
class MyClass {
    static function myCallbackMethod() {
        echo 'Hello World From class body!'.PHP_EOL;
    }
}

// Type 1: Simple callback
call_user_func('my_callback_function'); 

// Type 2: Static class method call
call_user_func(array('MyClass', 'myCallbackMethod')); 

// Type 3: Object method call
$obj = new MyClass();
call_user_func(array($obj, 'myCallbackMethod'));

// Type 4: Static class method call
call_user_func(array('MyClass','myCallbackMethod'));

// Type 5: Relative static class method call
class A {
    public static function who() {
        echo "A\n";
    }
}

class B extends A {
    public static function who() {
        echo "B\n";
    }
}

call_user_func(array('B', 'parent::who')); // A
/*
 * When running you should see
hello world!
Hello World From class body!
Hello World From class body!
Hello World From class body!
*/
?>