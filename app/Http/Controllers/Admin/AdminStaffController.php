<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ExceptionMessage;
use App\Exceptions\AdminResourcesNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStaffRequest;
use App\Models\Salary;
use App\Models\Staff;
use App\Models\StaffRole;
use App\Traits\Admin\AdminResourceTrait;
use App\Traits\Admin\AdminStaffTrait;
use Exception;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class AdminStaffController extends Controller
{
    use AdminResourceTrait, AdminStaffTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        try {
            $staff = Staff::query()
                ->orderBy('created_at', 'desc')
                ->when(Request::input('filters'), function ($query, $filters) {
                    if (isset($filters['searchName'])) {
                        $query->where('first_name', 'like', '%' . $filters['searchName'] . '%');
                        // ->orWhere('last_name', 'like', '%' . $filters['searchName'] . '%');
                    }

                    if (isset($filters['searchGroup'])) {
                        $query->whereHas('groups', function ($groupQuery) use ($filters) {
                            $groupQuery->where('name', 'like', '%' . $filters['searchGroup'] . '%');
                        });
                    }

                    if (isset($filters['searchSkill_level'])) {
                        $query->where('skill_level', $filters['searchSkill_level']);
                    }

                    if (isset($filters['searchYear'])) {
                        $query->whereYear('date_of_birth', $filters['searchYear']);
                    }
                })
                ->with(['salary', 'role'])
                ->paginate(9)
                ->withQueryString()
            ->through(function ($staff) {
                return [
                    'id' => $staff->id,
                    'first_name' => $staff->first_name,
                    'last_name' => $staff->last_name,
                    'email' => $staff->email,
                    'date_of_birth' => $staff->date_of_birth,
                    'phone' => $staff->phone,
                    'salary' => $staff->salary->name,
                    'role' => $staff->role->name,
                ];
            });
            // dd($staff);
            return Inertia::render('Admin/Staff/List', [
                'staff' => $staff,
                'salaries' => Salary::all(),
                'roles' => StaffRole::all(),
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
    public function create()
    {
        return $this->create_staff();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStaffRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreStaffRequest $request)
    {
        return $this->storeResource($request, Staff::class, 'admin.dashboard.staff.index', 'Membrul a fost adaugat cu succes.');
    }
}
