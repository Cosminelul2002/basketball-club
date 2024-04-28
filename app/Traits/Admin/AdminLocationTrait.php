<?php

namespace App\Traits\Admin;

use Inertia\Inertia;

trait AdminLocationTrait
{
    /**
     * Update the specified location.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateLocation($request, $location)
    {
        $data = $request->all();

        $updateData = array_filter($data, function ($value, $key) use ($location) {
            return $location->{$key} !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        $this->repoLocation->update($location->id, $updateData);

        return redirect()->route('admin.dashboard.locations.index')->with('message', 'Location updated successfully!');
    }
}
