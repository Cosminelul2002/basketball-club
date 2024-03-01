<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\SlugService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Products/List', [
            'products' => Product::all()->load('category'),
        ]);
    }

    public function show(Product $product)
    {
        return Inertia::render('Admin/Products/Show', [
            'product' => $product->load('category'),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Products/Create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $request->validated();

        $request->merge(['slug' => SlugService::createForModel(Product::class, $request->name)]);

        Product::create($request->all());

        return redirect()->route('admin.dashboard.products.index')->with('message', 'Produs adăugat cu succes!');
    }

    public function update(Request $request, Product $product)
    {
        $requestData = $request->all();

        $updateData = array_filter($requestData, function ($value, $key) use ($product) {
            return $product->{$key} !== $value;
        }, ARRAY_FILTER_USE_BOTH);

        $product->update($updateData);

        return redirect()->route('admin.dashboard.products.index')->with('message', 'Produs actualizat cu succes!');
    }
}
