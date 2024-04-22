<?php

namespace App\Repositories;

use App\Contracts\CoachRepositoryInterface;
use App\Models\Coach;
use Illuminate\Database\Eloquent\Collection;

class CoachRepository implements CoachRepositoryInterface
{
    /**
     * Retrieve all coaches.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return Coach::all();
    }

    /**
     * Find a coach by its ID.
     *
     * @param int $id
     * @return \App\Models\Coach|null
     */
    public function find(int $id): ?Coach
    {
        return Coach::find($id);
    }

    /**
     * Create a new coach.
     *
     * @param array $data
     * @return \App\Models\Coach
     */
    public function create(array $data): Coach
    {
        return Coach::create($data);
    }

    /**
     * Update a coach by its ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return Coach::find($id)->update($data);
    }

    /**
     * Delete a coach by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Coach::destroy($id);
    }
}
