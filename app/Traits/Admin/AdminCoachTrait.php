<?php

namespace App\Traits\Admin;

use App\Enums\ExceptionMessage;
use App\Exceptions\ResourcesNotFoundException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

trait AdminCoachTrait
{
    /**
     * Update an existing coach.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $coach
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCoach($request, $coach)
    {
        try {
            $data = $request->validated();
            $updateData = array_filter($data, function ($value, $key) use ($coach) {
                return $coach->{$key} !== $value;
            }, ARRAY_FILTER_USE_BOTH);

            $this->repoCoach->update($coach->id, $updateData);

            return redirect()->route('admin.dashboard.coaches.index')->with('message', 'Antrenor actualizat cu succes!');
        } catch (ModelNotFoundException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::ResourceNotFound('Coach'));
        } catch (QueryException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::QueryFailed('Coach'));
        } catch (Exception $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::GeneralUpdateResourceError());
        }
    }
}
