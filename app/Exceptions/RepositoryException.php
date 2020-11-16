<?php


namespace App\Exceptions;


use Exception;
use Throwable;

class RepositoryException extends Exception
{
    private $statusCode;

    /**
     * RepositoryException constructor.
     * @param string $statusCode
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($statusCode, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}