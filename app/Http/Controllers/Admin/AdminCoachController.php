<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Admin\AdminCoachTrait;
use App\Traits\Admin\AdminResourceTrait;
use App\Contracts\CoachRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoachRequest;
use App\Models\Coach;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminCoachController extends Controller
{
    use AdminCoachTrait, AdminResourceTrait;

    /**
     * The coach repository instance.
     *
     * @var CoachRepositoryInterface
     */
    private $repoCoach;

    /**
     * Create a new AdminCoachController instance.
     *
     * @param CoachRepositoryInterface $repoCoach
     * @return void
     */
    public function __construct(CoachRepositoryInterface $repoCoach)
    {
        $this->repoCoach = $repoCoach;
    }

    /**
     * Display a listing of the coaches.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->indexResources('Coaches', Coach::class);
    }

    /**
     * Display the specified coach.
     *
     * @param Coach $coach
     * @return \Inertia\Response
     */
    public function show(Coach $coach)
    {
        return $this->showResource('Coaches', $coach);
    }

    /**
     * Show the form for creating a new coach.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return $this->createResourceView('Coaches');
    }

    /**
     * Store a newly created coach in storage.
     *
     * @param StoreCoachRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCoachRequest $request)
    {
        return $this->storeResource($request, Coach::class, 'admin.dashboard.coaches.index', 'Antrenor adăugat cu succes!');
    }

    /**
     * Update the specified coach in storage.
     *
     * @param Request $request
     * @param Coach $coach
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Coach $coach)
    {
        return $this->updateCoach($request, $coach);
    }

    /**
     * Remove the specified coach from storage.
     *
     * @param Coach $coach
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Coach $coach)
    {
        return $this->destroyResource($coach, 'admin.dashboard.coaches.index', 'Antrenor șters cu succes!');
    }
}
