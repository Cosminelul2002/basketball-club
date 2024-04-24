<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductsRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\SlugService;
use App\Traits\Admin\AdminCategoryTrait;
use App\Traits\Admin\AdminResourceTrait;
use Codestage\Authorization\Attributes\Authorize;
use Illuminate\Http\Request;
use Inertia\Inertia;

#[Authorize]
class AdminCategoryController extends Controller
{

    use AdminCategoryTrait, AdminResourceTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    #[Authorize(roles: 'admin')]
    public function index()
    {
        return $this->index_categories();
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
        return $this->show_category($category);
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
        return $this->add_products_view($category);
    }

    /**
     * Store products to a category.
     * 
     * @param  \App\Models\Category  $category
     * @param  \App\Http\Requests\AddProductsRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    #[Authorize(roles: 'admin')]
    public function storeProducts(Category $category, AddProductsRequest $request)
    {
        return $this->store_products_to_category($category, $request);
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
        return $this->create_category_view();
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
        return $this->store_category($request);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \App\Models\Category  $category
     * @return \Inertia\Response
     */
    public function update(Category $category, StoreCategoryRequest $request)
    {
        dd('To be implemented');
        return $this->update_category($category, $request);
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
        $this->destroyResource($category, 'admin.dashboard.categories.index', 'Categorie ștearsă cu succes!');
    }
}
