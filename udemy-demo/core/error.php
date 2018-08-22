<?php
/** 
 *  Error and exception handler
 */
namespace core;

class Error
{
    /**
     * Converts error handler to exception handler.
     * $level   - error level
     * $message - error message
     * $file    - file name where the error occurred
     * $line    - line where the error was thrown
     */
    public static function errorHandler($level, $message, $file, $line) 
    {
        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Custom exception handler
     */

    public static function exceptionHandler($exception) 
    {
        $code = $exception->getCode();

        if($code != 404){
            $code = 500;
        }

        http_response_code($code);
        
        if(\app\Config::SHOW_ERRORS)
        {
            echo "<h1>System Exception</h1>";
            echo "<p>Uncaught exception:".get_class($exception)."</p>";
            echo "<p>Message:".$exception->getMessage()."</p>";
            echo "<p>Stack Trace:<pre>".$exception->getTraceAsString()."</pre></p>";
            echo "<p>Thrown in [".$exception->getFile()."] on line ["
                .$exception->getLine()."]</p>";
        }
        else{
            $log = dirname(__DIR__)."/logs/".date('Y-m-d').".log";
            \ini_set('error_log', $log);

            $message = "Uncaught exception: [".get_class($exception)."] ";
            $message .= "Message: [".$exception->getMessage()."] ";
            $message .= "Stack Trace: [".$exception->getTraceAsString()."] ";
            $message .= "Thrown in [".$exception->getFile()."] on line ["
                    .$exception->getLine()."]";

            error_log($message);
            // echo "<h1>System Exception</h1>";
            // echo "<p>A system error has occurred. Please contact XXX in case issue persists.</p>";
            View::renderTemplate("errors\\$code.html");
        }

    }
}

?>