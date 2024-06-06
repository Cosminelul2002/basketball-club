<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ExceptionMessage;
use App\Exceptions\AdminResourcesNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalaryRequest;
use App\Models\Salary;
use App\Traits\Admin\AdminResourceTrait;
use App\Traits\Admin\AdminSalaryTrait;
use Codestage\Authorization\Attributes\Authorize;
use Exception;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

#[Authorize(roles: 'admin')]
class AdminSalaryController extends Controller
{
    use AdminResourceTrait, AdminSalaryTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        try {
            $salaries = Salary::query()
                ->orderBy('created_at', 'desc')
                ->when(Request::input('filters'), function ($query, $filters) {
                    if (isset($filters['amount'])) {
                        $query->where('amount', 'like', '%' . $filters['amount'] . '%');
                    }

                    if (isset($filters['searchGroup'])) {
                        $query->whereHas('groups', function ($groupQuery) use ($filters) {
                            $groupQuery->where('name', 'like', '%' . $filters['searchGroup'] . '%');
                        });
                    }

                    if (isset($filters['type'])) {
                        $query->where('type', $filters['type']);
                    }

                    if (isset($filters['currency'])) {
                        $query->where('currency', $filters['currency']);
                    }

                    if (isset($filters['duration_type'])) {
                        $query->where('duration_type', $filters['duration_type']);
                    }
                })
                ->paginate(9)
                ->withQueryString();
            // dd($players);
            return Inertia::render('Admin/Salaries/List', [
                'salaries' => $salaries,
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
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Inertia\Response
     */
    public function show(Salary $salary)
    {
        return $this->showResource('Salaries', $salary);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Inertia\Response
     */
    public function create()
    {
        return $this->create_salary();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSalaryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSalaryRequest $request)
    {
        return $this->storeResource($request, Salary::class, 'admin.dashboard.salaries.index', 'Salariu creat cu succes.');
    }

    public function destroy(Salary $salary)
    {
        return $this->destroyResource($salary, 'admin.dashboard.salaries.index', 'Salariu șters cu succes.');
    }
}
