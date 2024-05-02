<?php

namespace App\Exceptions;

use Exception;
use App\Enums\ExceptionMessage;
use Illuminate\Database\Eloquent\Model;
use Inertia\Inertia;
use Throwable;

class AdminResourcesNotFoundException extends Exception
{
    protected $model;
    protected $code;

    public function __construct($message, $model = null, $code = 404, Exception $previous = null)
    {
        parent::__construct($message);
        $this->model = $model;
        $this->code = $code;
    }

    private function getModel()
    {
        return $this->model;
    }

    private function getHTTPCode()
    {
        return $this->code;
    }

    public function report()
    {
        // report to the logs
    }

    public function renderAdminErrorPage()
    {
        return Inertia::render('Errors/ErrorPage', [
            'message' => $this->getMessage(),
            'code' => $this->getHTTPCode()
        ]);
    }
}
