<?php

namespace App\Traits\Public;

use App\Enums\ExceptionMessage;
use App\Exceptions\PublicException;
use App\Models\Category;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Inertia\Inertia;

trait CategoryTrait
{
    /**
     * Display the specified resource category.
     *
     * @return \Inertia\Response
     */
    public function show_category(Category $category)
    {
        try {
            return Inertia::render('Category/Show', [
                'category' => $category->load('products'),
            ]);
        } catch (RelationNotFoundException $e) {
            throw new PublicException(ExceptionMessage::ResourceAssociatedNotFound('Products'));
        }
    }
}
