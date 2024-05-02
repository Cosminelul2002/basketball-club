<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\Public\CategoryTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    use CategoryTrait;

    public function show(Category $category)
    {
        return $this->show_category($category);
    }
}
