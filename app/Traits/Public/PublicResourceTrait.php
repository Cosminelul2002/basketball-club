<?php

namespace App\Traits\Public;

use App\Enums\ExceptionMessage;
use App\Exceptions\PublicException;
use App\Services\SingularLowerNouns;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Inertia\Inertia;

trait PublicResourceTrait
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index_resource($resource)
    {
        return Inertia::render("{$resource}/Index");
    }

    /**
     * Display the specified resource.
     *
     * @param string $resource The resource name (e.g., "User").
     * @param mixed $model The model instance to display.
     * @return \Inertia\Response
     */
    public function show_resource($resource, $model)
    {
        $fondModel = $model::findOrFail($model->id);

        try {
            return Inertia::render("{$resource}/Show", [
                lcfirst(SingularLowerNouns::makeSingularLowercase($resource)) => $fondModel,
            ]);
        } catch (ModelNotFoundException $e) {
            throw new PublicException(ExceptionMessage::ResourceNotFound($resource));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create_resource($resource)
    {
        return Inertia::render("{$resource}/Create");
    }
}
