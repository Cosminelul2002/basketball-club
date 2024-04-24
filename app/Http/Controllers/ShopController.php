<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\Public\ShopTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    use ShopTrait;

    /**
     * Display a listing of the resource for the shop page.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->index_shop();
    }

    public function checkout()
    {
        return Inertia::render('Shop/Checkout/Show');
    }
}
