<?php

namespace App\Traits\Admin;

use App\Enums\ExceptionMessage;
use App\Exceptions\AdminResourcesNotFoundException;
use App\Services\SingularLowerNouns;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
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
        try {
            return Inertia::render("Admin/{$resource}/Show", [
                lcfirst(SingularLowerNouns::makeSingularLowercase($resource)) => $model,
            ]);
        } catch (ModelNotFoundException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::ResourceNotFound($resource));
        } catch (Exception $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralResourceError());
        }
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
        try {
            $validatedData = $request->validated();
            $modelName::create($validatedData);
            return redirect()->route($redirectRoute)->with('message', $successMessage);
        } catch (Exception $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralStoreResourceError(), null, 500, $e);
        }
    }

    /**
     * Update an existing resource.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing the resource data.
     * @param mixed $model The model instance to update.
     * @param string $redirectRoute The route to redirect to after updating the resource.
     * @param string $successMessage The success message to display upon successful update.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateResource($request, $model, $redirectRoute, $successMessage)
    {
        $requestData = $request->validated();

        $updateData = array_filter($requestData, function ($value, $key) use ($model) {
            return $model->{$key} !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        $model->update($updateData);

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
        try {
            $model->delete();
            return redirect()->route($redirectRoute)->with('message', $successMessage);
        } catch (Exception $e) {
            $className = basename(str_replace('\\', '/', get_class($model)));
            throw new AdminResourcesNotFoundException(ExceptionMessage::DeleteResourceError($className, null, 500, $e));
        }
    }
}
