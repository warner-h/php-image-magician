<?php
/**
 * Custom exception class for imageLib
 *
 * This exception is thrown when image manipulation operations fail
 */
class ImageLibException extends \Exception
{
    /**
     * Constructor
     *
     * @param string $message The exception message
     * @param int $code The exception code
     */
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
