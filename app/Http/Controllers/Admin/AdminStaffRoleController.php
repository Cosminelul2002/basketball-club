<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ExceptionMessage;
use App\Exceptions\AdminResourcesNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaffRoleRequest;
use App\Models\StaffRole;
use App\Traits\Admin\AdminResourceTrait;
use Exception;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class AdminStaffRoleController extends Controller
{
    use AdminResourceTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        try {
            $staffRoles = StaffRole::query()
                ->orderBy('created_at', 'desc')
                ->when(Request::input('filters'), function ($query, $filters) {
                    if (isset($filters['searchName'])) {
                        $query->where('name', 'like', '%' . $filters['searchName'] . '%');
                        // ->orWhere('last_name', 'like', '%' . $filters['searchName'] . '%');
                    }

                    if (isset($filters['searchDescription'])) {
                        $query->where('description', 'like', '%' . $filters['searchDescription'] . '%');
                    }
                })
                ->paginate(9)
                ->withQueryString()
                ->through(function ($staffRoles) {
                    return [
                        'id' => $staffRoles->id,
                        'name' => $staffRoles->name,
                        'description' => $staffRoles->description,
                        'created_at' => $staffRoles->created_at->format('Y-m-d H:i:s'),
                        'updated_at' => $staffRoles->updated_at->format('Y-m-d H:i:s'),
                    ];
                });
                // dd($staffRoles);
            return Inertia::render('Admin/StaffRoles/List', [
                'staffRoles' => $staffRoles,
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
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function show(StaffRole $staffRole)
    {
        return $this->showResource('StaffRole', $staffRole);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(StaffRole $staffRole)
    {
        return $this->createResourceView('StaffRoles');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreStaffRoleRequest $request)
    {
        return $this->storeResource($request, StaffRole::class, 'admin.dashboard.staff-roles.index', 'Rolul a fost adaugat cu succes.');
    }

    public function destroy(StaffRole $staffRole)
    {
        return $this->destroyResource($staffRole, 'admin.dashboard.staff-roles.index', 'Rolul a fost sters cu succes.');
    }
}
