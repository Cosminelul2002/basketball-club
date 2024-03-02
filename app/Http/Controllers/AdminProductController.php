<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
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
            'categories' => Category::all(),
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
}
