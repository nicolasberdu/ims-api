<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    public $table = 'products';

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'product_name',
        'description',
        'category_code',
        'price',
        'is_enabled'
    ];

    public function category(): HasMany {
        return $this->hasMany(
            Category::class,
            'category_code'
        );
    }
}