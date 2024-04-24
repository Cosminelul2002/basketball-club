<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Admin\AdminLocationTrait;
use App\Traits\Admin\AdminResourceTrait;
use App\Contracts\LocationRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Location;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use Inertia\Inertia;

#[Authorize(roles: 'admin')]
class AdminLocationController extends Controller
{
    use AdminLocationTrait, AdminResourceTrait;

    /**
     * The location repository instance.
     *
     * @var LocationRepositoryInterface
     */
    private $repoLocation;

    /**
     * Create a new AdminLocationController instance.
     *
     * @param LocationRepositoryInterface $repoLocation
     * @return void
     */
    public function __construct(LocationRepositoryInterface $repoLocation)
    {
        $this->repoLocation = $repoLocation;
    }

    /**
     * Display a listing of the locations.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->indexResources('Locations', Location::class);
    }

    /**
     * Display the specified location.
     *
     * @param \App\Models\Location $location
     * @return \Inertia\Response
     */
    public function show(Location $location)
    {
        return $this->showResource('Locations', $location);
    }

    /**
     * Show the form for creating a new location.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return $this->createResourceView('Locations');
    }

    /**
     * Store a newly created location in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        return $this->storeResource($request, Location::class, 'admin.dashboard.locations.index', 'Locație adăugată cu succes!');
    }

    /**
     * Update the specified location in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Location $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Location $location)
    {
        return $this->updateLocation($request, $location);
    }

    /**
     * Remove the specified location from storage.
     *
     * @param \App\Models\Location $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Location $location)
    {
        return $this->destroyResource($location, 'admin.dashboard.locations.index', 'Locație ștearsă cu succes!');
    }
}
