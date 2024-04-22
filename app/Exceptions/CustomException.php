<?php

namespace App\Exceptions;

use Exception;
use Inertia\Inertia;

class CustomException extends Exception
{

    public function report()
    {
        // report to the logs
    }

    public function render($request)
    {
        return redirect()->back()->withErrors(['message' => $this->getMessage()]);
    }

    public function renderForConsole($output)
    {
        // render for console
    }

    public function renderForApi($request)
    {
        return response()->json(['message' => 'Custom error message'], 500);
    }

    public function renderForWeb($request)
    {
        return response()->view('errors.custom', [], 500);
    }

    public function renderForJson($request)
    {
        return response()->json(['message' => 'Custom error message'], 500);
    }

    public function renderForNova($request)
    {
        return response()->view('errors.custom', [], 500);
    }

    public function renderForInertia($request)
    {
        return redirect()->back()->with('message', `{$this->getMessage()}`);
    }
}
