<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Admin\AdminLocationTrait;
use App\Traits\Admin\AdminResourceTrait;
use App\Contracts\LocationRepositoryInterface;
use App\Enums\ExceptionMessage;
use App\Exceptions\AdminResourcesNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use Codestage\Authorization\Attributes\Authorize;
use Exception;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
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
        try {
            $locations = Location::query()
                ->orderBy('created_at', 'desc')
                ->when(Request::input('filters'), function ($query, $filters) {
                    if (isset($filters['searchAddress'])) {
                        $query->where('address', 'like', '%' . $filters['searchAddress'] . '%');
                    }

                    if (isset($filters['searchCity'])) {
                        $query->where('city', 'like', '%' . $filters['searchCity'] . '%');
                    }

                    if (isset($filters['searchArea'])) {
                        $query->where('area', 'like', '%' . $filters['searchArea'] . '%');
                    }
                })
                ->paginate(9)
                ->withQueryString();
            // dd($players);
            return Inertia::render('Admin/Locations/List', [
                'locations' => $locations,
                'prevFilters' => Request::input('filters') ?? [],
            ]);
        } catch (RelationNotFoundException $e) {
            dd($e);
            throw new AdminResourcesNotFoundException(ExceptionMessage::ResourceAssociatedNotFound('Groups'), null, 500, $e);
        } catch (QueryException $e) {
            dd($e);
            throw new AdminResourcesNotFoundException(ExceptionMessage::QueryFailed('Players'), null, 500, $e);
        } catch (Exception $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
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
    public function store(StoreLocationRequest $request)
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
    public function update(UpdateLocationRequest $request, Location $location)
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
