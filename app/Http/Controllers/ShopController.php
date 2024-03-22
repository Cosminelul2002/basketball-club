<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all()->take(5);

        return Inertia::render('Shop/Show', [
            'categories' => $categories,
        ]);
    }

    public function checkout()
    {
        return Inertia::render('Shop/Checkout/Show');
    }
}
