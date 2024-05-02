<?php

namespace App\Traits\Public;

use App\Exceptions\PublicException;
use App\Models\Coach;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Inertia\Inertia;

trait CoachTrait
{
    /**
     * Display a listing of the resource for the coaches.
     *
     * @return \Inertia\Response
     */
    public function index_coach()
    {
        $coaches = Coach::all();

        if ($coaches->isEmpty()) {
            throw new PublicException('No coaches found.', 404);
        }

        return Inertia::render('Coaches/Index', [
            'coaches' => Coach::all(),
        ]);
    }
}
