<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'availability',
        'price',
        'image',
    ];

    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'products';

    /**
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'slug';

    /**
     * The "type" of the primary key ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
