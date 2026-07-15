<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = [
        'category_id', 'name', 'description', 'price', 'unit',
        'stock_status', 'is_hot', 'image_path', 'is_preorder_available',
    ];

    protected function casts(): array
    {
        return [
            'is_hot' => 'boolean',
            'is_preorder_available' => 'boolean',
            'price' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function averageRating(): float
    {
        return round($this->reviews()->avg('rating') ?? 5, 1);
    }
}
