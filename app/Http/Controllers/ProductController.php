<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\Public\ProductTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    use ProductTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function show(Product $product)
    {
        return $this->show_product($product);
    }
}
