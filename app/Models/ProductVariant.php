<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id", "name", "flavor", "size", "sku", "price", "stock", "is_active",
    ];

    protected $casts = [
        "is_active" => "boolean",
        "price" => "decimal:2",
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function inStock(): bool
    {
        return $this->stock > 0;
    }
}
