<?php

namespace App\Traits\Public;

use App\Models\Category;
use Inertia\Inertia;

trait ShopTrait
{
    /**
     * Display a listing of the resource for the shop page.
     *
     * @return \Inertia\Response
     */
    public function index_shop()
    {
        $categories = Category::all()->take(5);

        return Inertia::render('Shop/Index', [
            'categories' => $categories,
        ]);
    }
}
