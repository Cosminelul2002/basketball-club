<?php

namespace App\Http\Controllers;

use App\Models\Join;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use Inertia\Inertia;

#[Authorize]
class AdminJoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function index()
    {
        $joins = Join::orderByDesc('created_at')->get();

        return Inertia::render('Admin/Joins/List', [
            'joins' => $joins,
        ]);
    }

    /**
     * Approve the specified resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Join  $join
     */
    #[Authorize(roles: 'admin')]
    public function approve(Request $request, Join $join)
    {
        $join->update([
            'approved' => true,
        ]);

        return redirect()->back()->with('message', 'Cererea a fost aprobata');
    }
}
