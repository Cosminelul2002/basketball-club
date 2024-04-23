<?php

namespace App\Traits\Admin;

use App\Services\SingularLowerNouns;
use Inertia\Inertia;

/**
 * The AdminResourceTrait provides methods for handling resource management in the admin panel.
 */
trait AdminResourceTrait
{
    /**
     * Render the index page for a resource.
     *
     * @param string $resource The resource name (e.g., "Users").
     * @param string $modelName The fully qualified model class name.
     * @return \Inertia\Response
     */
    public function indexResources($resource, $modelName)
    {
        return Inertia::render("Admin/{$resource}/List", [
            strtolower($resource) => $modelName::all(),
        ]);
    }

    /**
     * Render the show page for a resource.
     *
     * @param string $resource The resource name (e.g., "User").
     * @param mixed $model The model instance to display.
     * @return \Inertia\Response
     */
    public function showResource($resource, $model)
    {
        return Inertia::render("Admin/{$resource}/Show", [
            lcfirst(SingularLowerNouns::makeSingularLowercase($resource)) => $model,
        ]);
    }

    /**
     * Render the create page for a resource.
     *
     * @param string $resource The resource name (e.g., "User").
     * @return \Inertia\Response
     */
    public function createResourceView($resource)
    {
        return Inertia::render("Admin/{$resource}/Create");
    }

    /**
     * Store a new resource in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request.
     * @param string $modelName The fully qualified model class name.
     * @param string $redirectRoute The route to redirect to after storing the resource.
     * @param string $successMessage The success message to display upon successful storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeResource($request, $modelName, $redirectRoute, $successMessage)
    {
        $validatedData = $request->validated();
        $modelName::create($validatedData);
        return redirect()->route($redirectRoute)->with('message', $successMessage);
    }

    /**
     * Delete a resource from the database.
     *
     * @param mixed $model The model instance to delete.
     * @param string $redirectRoute The route to redirect to after deleting the resource.
     * @param string $successMessage The success message to display upon successful deletion.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyResource($model, $redirectRoute, $successMessage)
    {
        $model->delete();
        return redirect()->route($redirectRoute)->with('message', $successMessage);
    }
}
