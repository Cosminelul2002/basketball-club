<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
}
