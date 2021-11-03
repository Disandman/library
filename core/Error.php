<?php

namespace App\core;

/**
 * Error and exception handler
 *
 * PHP version 7.0
 */
class Error
{

    /**
     * Error handler. Convert all errors to Exceptions by throwing an ErrorException.
     *
     * @param int $level Error level
     * @param string $message Error message
     * @param string $file Filename the error was raised in
     * @param int $line Line number in the file
     *
     * @return void
     */
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() !== 0) {  // to keep the @ operator working
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Exception handler.
     *
     * @param Exception $exception The exception
     *
     * @return void
     */
    public static function exceptionHandler($exception)
    {
        $code = $exception->getCode();
            http_response_code($code);

            $message =  "<h1>Fatal error</h1>";
            $message .=  "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
            $message .=  "<p>Message: '" . $exception->getMessage() . "'</p>";
            $message .=  "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
            $message .=  "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";

            View::render('Неустранимая ошибка',"/layouts/errors.php",['massage' => $message]);
        }
}
