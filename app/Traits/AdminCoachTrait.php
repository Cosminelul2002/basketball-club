<?php

namespace App\Traits;

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
        $data = $request->all();

        $updateData = array_filter($data, function ($value, $key) use ($coach) {
            return $coach->{$key} !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        $this->repoCoach->update($coach->id, $updateData);

        return redirect()->route('admin.dashboard.coaches.index')->with('message', 'Antrenor actualizat cu succes!');
    }
}
