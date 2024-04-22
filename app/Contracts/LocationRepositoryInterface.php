<?php

namespace App\Contracts;

use App\Models\Location;

interface LocationRepositoryInterface
{
    /**
     * Get all locations.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): \Illuminate\Database\Eloquent\Collection;

    /**
     * Get a location by ID.
     *
     * @param int $id
     * @return \App\Models\Location|null
     */
    public function find(int $id): ?Location;

    /**
     * Create a new location.
     *
     * @param array $data
     * @return \App\Models\Location
     */
    public function create(array $data): Location;

    /**
     * Update a location.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a location.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
