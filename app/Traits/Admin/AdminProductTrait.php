<?php

namespace App\Traits\Admin;

use App\Enums\ExceptionMessage;
use App\Exceptions\AdminResourcesNotFoundException;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\SlugService;
use Exception;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Inertia\Inertia;

trait AdminProductTrait
{
    /**
     * Display a listing of products.
     * 
     * @return \Inertia\Response The Inertia response containing the list of products.
     * @throws \Inertia\Response
     */
    public function index_products()
    {
        try {
            return Inertia::render('Admin/Products/List', [
                'products' => Product::all()->load('category'),
                'categories' => Category::all(),
            ]);
        } catch (RelationNotFoundException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::ResourceAssociatedNotFound('Category'), null, 500, $e);
        } catch (QueryException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::QueryFailed('Products'), null, 500, $e);
        } catch (Exception $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product The product to display.
     * @return \Inertia\Response The Inertia response containing the product.
     */
    public function show_product(Product $product)
    {
        try {
            return Inertia::render('Admin/Products/Show', [
                'product' => $product->load('category'),
                'categories' => Category::all(),
            ]);
        } catch (RelationNotFoundException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::ResourceAssociatedNotFound('Category'), null, 500, $e);
        } catch (Exception $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Inertia\Response The Inertia response containing the form for creating a new product.
     */
    public function create_product_view()
    {
        return Inertia::render('Admin/Products/Create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a new product in the database.
     *
     * @param \Illuminate\Http\StoreProductRequest $request The HTTP request containing product data.
     * @return \Illuminate\Http\RedirectResponse A redirect response indicating the result of the operation.
     */
    public function store_product(StoreProductRequest $request)
    {
        $request->validated();

        Product::create($request->validated());

        return redirect()->route('admin.dashboard.products.index')->with('message', 'Produs adăugat cu succes!');
    }

    /**
     * Update the specified product in the database.
     *
     * @param \Illuminate\Http\UpdateProductRequest $request The HTTP request containing product data.
     * @param \App\Models\Product $product The product to update.
     * @return \Illuminate\Http\RedirectResponse A redirect response indicating the result of the operation.
     */
    public function update_product(UpdateProductRequest $request, Product $product)
    {
        try {
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
        } catch (RelationNotFoundException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::ResourceAssociatedNotFound('Category'), null, 500, $e);
        } catch (QueryException $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::QueryFailed('Products'), null, 500, $e);
        } catch (Exception $e) {
            throw new AdminResourcesNotFoundException(ExceptionMessage::GeneralError(), null, 500, $e);
        }
    }
}
