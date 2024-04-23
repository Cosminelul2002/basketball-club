<?php

namespace App\Traits\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

/**
 * The AdminCategoryTrait provides methods for managing categories in the admin panel.
 */
trait AdminCategoryTrait
{

    /**
     * Display a listing of categories.
     * 
     * @return \Inertia\Response The Inertia response containing the list of categories.
     * @throws \Inertia\Response
     */
    public function index_categories()
    {
        return Inertia::render('Admin/Categories/List', [
            'categories' => Category::all()->load('products')
        ]);
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Models\Category  $category The category to display.
     * @return \Inertia\Response The Inertia response containing the category.
     */
    public function show_category(Category $category)
    {
        return Inertia::render('Admin/Categories/Show', [
            'category' => $category->load('products')
        ]);
    }

    /**
     * Store a new category in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing category data.
     * @return \Illuminate\Http\RedirectResponse A redirect response indicating the result of the operation.
     */
    public function store_category(Request $request)
    {
        $categoryName = $request->input('name');

        $slug = SlugService::createForModel(Category::class, $categoryName);

        $category = new Category();
        $category->name = $categoryName;
        $category->slug = $slug;
        $category->save();

        $category = Category::where('slug', $slug)->first();

        if ($request->products) {
            $products = Product::whereIn('id', $request->products)->get();

            foreach ($products as $product) {
                $product->category_id = $category->id;
                $product->save();
            }
        }

        return Redirect::route('admin.dashboard.categories.index')->with('message', 'Categorie adăugată cu succes!');
    }

    /**
     * Show the view to add products to a category.
     * 
     * @param  \App\Models\Category  $category The category to which to add products.
     * @return \Inertia\Response The Inertia response containing the category and products.
     */
    public function add_products_view(Category $category)
    {
        return Inertia::render('Admin/Categories/AddProducts', [
            'category' => $category->load('products'),
            'products' => Product::all()->load('category')
        ]);
    }

    /**
     * Add products to a category.
     * 
     * @param  \App\Models\Category  $category The category to which to add products.
     * @param  \Illuminate\Http\Request  $request The HTTP request containing the products to add.
     * @return \Illuminate\Http\RedirectResponse A redirect response indicating the result of the operation.
     * @throws \Inertia\Response
     * @throws \Illuminate\Http\RedirectResponse
     */
    public function store_products_to_category(Category $category, Request $request)
    {
        $products = Product::whereIn('id', $request->products)->get();

        foreach ($products as $product) {
            if ($product->category_id !== $category->id) {
                $product->category_id = $category->id;
                $product->save();
                $ok = true;
            }
        }

        if ($ok) {
            return Redirect::route('admin.dashboard.categories.index')->with('message', 'Produse adăugate cu succes!');
        } else {
            return Redirect::route('admin.dashboard.categories.add-products', $category)->with('message', 'Produsele sunt deja în această categorie!');
        }
    }

    /**
     * Show the view to create a new category.
     * 
     * @return \Inertia\Response The Inertia response containing the list of products.
     */
    public function create_category_view()
    {
        return Inertia::render('Admin/Categories/Create', [
            'products' => Product::whereNull('category_id')->get(),
        ]);
    }
}
