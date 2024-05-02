<?php

namespace App\Traits\Admin;

use App\Enums\ExceptionMessage;
use App\Exceptions\AdminResourcesNotFoundException;
use App\Models\Join;
use App\Services\JoinService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

trait AdminJoinTrait
{

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index_joins()
    {
        try {
            return Inertia::render('Admin/Joins/List', [
                'joins' => Join::orderByDesc('created_at')->get(),
            ]);
        } catch (QueryException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::ResourceNotFound('Joins'), null, 404, $e);
        } catch (\Exception $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
    }

    /**
     * Approve the specified resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Join  $join
     */
    public function approve_join(Request $request, Join $join)
    {
        JoinService::createPlayerFromJoin($join);
    }
}
