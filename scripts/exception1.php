<?
/*
 * Test the exception mechansim
 */
 /* When running,you should see
 Uncaught NewException, code: 1
 Message: Catch me once
 Uncaught Exception, code: 2
 Message: Catch me twice
*/
set_exception_handler( 'exc_handler' );
class ExceptionHandler {  
    public static function printException(Exception $e)
    {
        print 'Uncaught '.get_class($e).', code: ' . $e->getCode() . "\nMessage: " . htmlentities($e->getMessage())."\n";
    }
  
    public static function handleException(Exception $e)
    {
         self::printException($e);
    }
}

set_exception_handler(array("ExceptionHandler", "handleException"));

class NewException extends Exception {}
try {
  throw new NewException("Catch me once", 1);
} catch (Exception $e) {
  ExceptionHandler::handleException($e);
}

throw new Exception("Catch me twice", 2);
?>