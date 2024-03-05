<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    public $table = 'categories';

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'category',
        'description',
    ];

    protected $casts = [
        'code' => 'string',
    ];

    public function products(): BelongsToMany {
        return $this->belongsToMany(
            Product::class, 
            'products', 
            'category_code',
            'code'
        );
    }
}