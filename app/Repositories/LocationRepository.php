<?php

namespace App\Repositories;

use App\Contracts\LocationRepositoryInterface;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class LocationRepository
 *
 * This class provides an implementation of the LocationRepositoryInterface.
 */
class LocationRepository implements LocationRepositoryInterface
{
    /**
     * Retrieve all locations.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return Location::all();
    }

    /**
     * Find a location by its ID.
     *
     * @param int $id
     * @return \App\Models\Location|null
     */
    public function find(int $id): ?Location
    {
        return Location::find($id);
    }

    /**
     * Create a new location.
     *
     * @param array $data
     * @return \App\Models\Location
     */
    public function create(array $data): Location
    {
        return Location::create($data);
    }

    /**
     * Update a location by its ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $location = Location::find($id);
        if ($location) {
            return $location->update($data);
        }
        return false;
    }

    /**
     * Delete a location by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Location::destroy($id);
    }
}
