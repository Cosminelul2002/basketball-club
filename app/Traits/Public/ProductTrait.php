<?php

namespace App\Traits\Public;

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
        return Inertia::render('Product/Show', [
            'product' => $product->load('category'),
        ]);
    }
}
