<?php

namespace App\Exceptions;

use Exception;
use Inertia\Inertia;

class PublicException extends Exception
{
    protected $code;
    protected $model;
    protected $message;

    public function __construct($message, $code = 404, $model = null, Exception $previous = null)
    {
        parent::__construct($message);
        $this->code = $code;
    }

    private function getHTTPErrorCode()
    {
        return $this->code;
    }

    public function report()
    {
        // report to the logs
    }

    public function renderPublicErrorPage()
    {
        return Inertia::render('Errors/PublicErrorPage', [
            'errorMessage' => $this->getMessage(),
            'errorCode' => $this->getHTTPErrorCode(),
        ]);
    }
}
