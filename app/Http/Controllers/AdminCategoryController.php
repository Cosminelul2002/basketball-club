<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\SlugService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Categories/List', [
            'categories' => Category::all()->load('products')
        ]);
    }

    public function show(Category $category)
    {
        return Inertia::render('Admin/Categories/Show', [
            'category' => $category->load('products')
        ]);
    }

    public function addProdcuts(Category $category)
    {
        return Inertia::render('Admin/Categories/AddProducts', [
            'category' => $category->load('products'),
            'products' => Product::all()->load('category')
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Categories/Create', [
            'products' => Product::whereNull('category_id')->get(),
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $categoryName = $request->input('name');

        $slug = SlugService::createForModel(Category::class, $categoryName);

        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = $slug;
        $category->save();

        $category = Category::where('slug', $slug)->first();

        $products = Product::whereIn('id', $request->products)->get();

        foreach ($products as $product) {
            $product->category_id = $category->id;
            $product->save();
        }

        return redirect()->route('admin.dashboard.categories.index')->with('message', 'Categorie adăugată cu succes!');
    }
}
