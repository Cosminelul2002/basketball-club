<?php

namespace App\Contracts;

use App\Models\Coach;

interface CoachRepositoryInterface
{
    /**
     * Get all coaches.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): \Illuminate\Database\Eloquent\Collection;

    /**
     * Get a coach by ID.
     *
     * @param int $id
     * @return \App\Models\Coach|null
     */
    public function find(int $id): ?Coach;

    /**
     * Create a new coach.
     *
     * @param array $data
     * @return \App\Models\Coach
     */
    public function create(array $data): Coach;

    /**
     * Update a coach.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a coach.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
