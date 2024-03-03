<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductsRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\SlugService;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use Inertia\Inertia;

#[Authorize]
class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function index()
    {
        return Inertia::render('Admin/Categories/List', [
            'categories' => Category::all()->load('products')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function show(Category $category)
    {
        return Inertia::render('Admin/Categories/Show', [
            'category' => $category->load('products')
        ]);
    }

    /**
     * Show the view to add products to a category.
     * 
     * @param  \App\Models\Category  $category
     * @return \Inertia\Response
     * @throws \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function addProdcuts(Category $category)
    {
        return Inertia::render('Admin/Categories/AddProducts', [
            'category' => $category->load('products'),
            'products' => Product::all()->load('category')
        ]);
    }

    public function storeProducts(Category $category, AddProductsRequest $request)
    {
        $products = Product::whereIn('name', $request->products)->get();

        // make change only if the products are not already in the category
        foreach ($products as $product) {
            if ($product->category_id !== $category->id) {
                $product->category_id = $category->id;
                $product->save();
                $ok = true;
            }
        }

        if ($ok) {
            return redirect()->route('admin.dashboard.categories.index')->with('message', 'Produse adăugate cu succes!');
        } else {
            return redirect()->route('admin.dashboard.categories.add-products', $category)->with('message', 'Produsele sunt deja în această categorie!');
        }
    }

    /**
     * Add products to a category.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    #[Authorize(roles: 'admin')]
    public function create()
    {
        return Inertia::render('Admin/Categories/Create', [
            'products' => Product::whereNull('category_id')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    #[Authorize(roles: 'admin')]
    public function store(StoreCategoryRequest $request)
    {
        $categoryName = $request->input('name');

        $slug = SlugService::createForModel(Category::class, $categoryName);

        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = $slug;
        $category->save();

        $category = Category::where('slug', $slug)->first();

        if (!$request->products) {
            return redirect()->route('admin.dashboard.categories.index')->with('message', 'Categorie adăugată cu succes!');
        } else {
            $products = Product::whereIn('id', $request->products)->get();

            foreach ($products as $product) {
                $product->category_id = $category->id;
                $product->save();
            }
        }
    }

    /**
     * Delete the specified resource from storage.
     * 
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    #[Authorize(roles: 'admin')]
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.dashboard.categories.index')->with('message', 'Categorie ștearsă cu succes!');
    }
}
