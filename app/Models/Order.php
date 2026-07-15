<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'customer_name', 'customer_phone',
        'customer_address', 'notes', 'subtotal', 'discount', 'total',
        'points_earned', 'points_used', 'payment_method', 'payment_status',
        'order_status', 'is_preorder', 'delivery_date', 'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'is_preorder' => 'boolean',
            'delivery_date' => 'date',
            'paid_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber(): string
    {
        $prefix = 'LPK';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -4));
        return "{$prefix}-{$date}-{$random}";
    }
}
