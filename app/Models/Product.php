<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_id", "name", "slug", "description", "base_price", "image", "is_active",
    ];

    protected $casts = [
        "is_active" => "boolean",
        "base_price" => "decimal:2",
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function activeVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->where("is_active", true);
    }

    public function cheapestPrice()
    {
        return $this->variants()->min("price") ?? $this->base_price;
    }
}
