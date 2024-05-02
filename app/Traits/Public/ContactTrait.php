<?php

namespace App\Traits\Public;

use App\Enums\ExceptionMessage;
use App\Exceptions\PublicException;
use App\Models\Coach;
use App\Models\Location;
use Inertia\Inertia;

trait ContactTrait
{
    /**
     * Display a listing of the resource for the contact page.
     *
     * @return \Inertia\Response
     */
    public function index_contact()
    {
        $coaches = Coach::all();
        $locations = Location::all();

        if ($coaches->isEmpty() || $locations->isEmpty()) {
            throw new PublicException(ExceptionMessage::ResourceNotFound('Coaches or Locations'));
        }

        return Inertia::render('Contact/Index', [
            'coaches' => Coach::all(),
            'locations' => Location::all(),
        ]);
    }
}
