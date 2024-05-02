<?php

namespace App\Traits\Public;

use App\Enums\ExceptionMessage;
use App\Exceptions\PublicException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Inertia\Inertia;

trait ProductTrait
{
    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Inertia\Response
     */
    public function show_product($product)
    {
        try {
            return Inertia::render('Product/Show', [
                'product' => $product->load('category'),
            ]);
        } catch (RelationNotFoundException $e) {
            throw new PublicException(ExceptionMessage::ResourceAssociatedNotFound('Category'));
        }
    }
}
