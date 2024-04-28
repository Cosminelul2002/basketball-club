<?php

namespace App\Traits\Admin;

use App\Enums\ExceptionMessage;
use App\Exceptions\ResourcesNotFoundException;
use App\Models\Category;
use App\Models\Product;
use App\Services\SlugService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
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
        try {
            $categories = Category::all()->load('products');
        } catch (RelationNotFoundException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::ResourceAssociatedNotFound('Products'));
        }

        return Inertia::render('Admin/Categories/List', (compact('categories')));
    }

    /**
     * Display the specified category.
     *
     * @param  \App\Models\Category  $category The category to display.
     * @return \Inertia\Response The Inertia response containing the category.
     */
    public function show_category(Category $category)
    {

        try {
            $categoryWithProducts = $category->load('products');

            return Inertia::render('Admin/Categories/Show', [
                'category' => $categoryWithProducts,
            ]);
        } catch (ModelNotFoundException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::ResourceNotFound('Category'));
        } catch (RelationNotFoundException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::ResourceAssociatedNotFound('Products'));
        } catch (QueryException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::QueryFailed('Category'));
        }
    }

    /**
     * Store a new category in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing category data.
     * @return \Illuminate\Http\RedirectResponse A redirect response indicating the result of the operation.
     */
    public function store_category(Request $request)
    {
        try {
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

            return redirect()->route('admin.dashboard.categories.index')->with('message', 'Categorie adăugată cu succes!');
        } catch (Exception $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::GeneralStoreResourceError(), null, 500, $e);
        } catch (QueryException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::QueryFailed('Category'), null, 500, $e);
        }
    }

    /**
     * Show the view to add products to a category.
     * 
     * @param  \App\Models\Category  $category The category to which to add products.
     * @return \Inertia\Response The Inertia response containing the category and products.
     */
    public function add_products_view(Category $category)
    {
        try {
            $products = Product::all()->load('category');

            return Inertia::render('Admin/Categories/AddProducts', [
                'category' => $category->load('products'),
                'products' => $products
            ]);
        } catch (RelationNotFoundException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::ResourceAssociatedNotFound('Products'));
        }
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
        try {
            $products = Product::whereIn('id', $request->products)->get();

            $ok = false;
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
        } catch (ModelNotFoundException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::ResourceNotFound('Category'));
        } catch (QueryException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::QueryFailed('Category'));
        } catch (Exception $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::GeneralStoreResourceError(), null, 500, $e);
        }
    }

    /**
     * Show the view to create a new category.
     * 
     * @return \Inertia\Response The Inertia response containing the list of products.
     */
    public function create_category_view()
    {
        try {
            $products = Product::whereNull('category_id')->get();

            return Inertia::render('Admin/Categories/Create', [
                'products' => $products,
            ]);
        } catch (QueryException $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::QueryFailed('Products'));
        } catch (Exception $e) {
            throw new ResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
    }
}
