<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return Inertia::render('Shop/Show', [
            'categories' => $categories,
        ]);
    }
}
