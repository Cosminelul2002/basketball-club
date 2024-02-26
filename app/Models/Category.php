<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'image',
        'parent_id'
    ];

    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'categories';

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
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
