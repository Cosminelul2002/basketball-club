<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\SlugService;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use Inertia\Inertia;

#[Authorize]
#[Authorize(roles: 'admin')]
class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Products/List', [
            'products' => Product::all()->load('category'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Inertia\Response
     */
    public function show(Product $product)
    {
        return Inertia::render('Admin/Products/Show', [
            'product' => $product->load('category'),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Products/Create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        $request->validated();

        $request->merge(['slug' => SlugService::createForModel(Product::class, $request->name)]);

        Product::create($request->all());

        return redirect()->route('admin.dashboard.products.index')->with('message', 'Produs adăugat cu succes!');
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
        $requestData = $request->validated();

        $updateData = array_filter($requestData, function ($value, $key) use ($product) {
            return $product->{$key} !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        if (array_key_exists('category', $updateData)) {
            $category = Category::where('name', $updateData['category'])->first();
            $updateData['category_id'] = $category->id;
            unset($updateData['category']);
        }

        $product->update($updateData);

        return redirect()->route('admin.dashboard.products.index')->with('message', 'Produs actualizat cu succes!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.dashboard.products.index')->with('message', 'Produs șters cu succes!');
    }
}
