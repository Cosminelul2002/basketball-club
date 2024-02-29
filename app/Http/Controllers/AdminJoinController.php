<?php

namespace App\Http\Controllers;

use App\Models\Join;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminJoinController extends Controller
{
    public function index()
    {
        $joins = Join::orderByDesc('created_at')->get();

        return Inertia::render('Admin/Joins/List', [
            'joins' => $joins,
        ]);
    }

    public function approve(Request $request, Join $join)
    {
        $join->update([
            'approved' => true,
        ]);

        return redirect()->back()->with('message', 'Cererea a fost aprobata');
    }
}
