<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\Admin\AdminProductTrait;
use App\Traits\Admin\AdminResourceTrait;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use Inertia\Inertia;

#[Authorize]
#[Authorize(roles: 'admin')]
class AdminProductController extends Controller
{

    use AdminProductTrait, AdminResourceTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return $this->index_products();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Inertia\Response
     */
    public function show(Product $product)
    {
        return $this->show_product($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Inertia\Response
     */
    public function create()
    {
        return $this->create_product_view();
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        return $this->store_product($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        return $this->update_product($request, $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        return $this->destroyResource($product, 'admin.dashboard.products.index', 'Produs șters cu succes!');
    }
}
