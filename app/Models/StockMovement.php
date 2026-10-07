<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovement extends Model
{
    public const TYPES = [
        'initial'    => 'Stok awal',
        'restock'    => 'Penambahan stok',
        'sale'       => 'Terjual (pesanan)',
        'return'     => 'Kembali (pesanan batal)',
        'adjustment' => 'Koreksi stok',
    ];

    public const TYPE_COLORS = [
        'initial'    => 'gray',
        'restock'    => 'success',
        'sale'       => 'warning',
        'return'     => 'info',
        'adjustment' => 'danger',
    ];

    protected $fillable = [
        'product_id', 'order_id', 'user_id', 'type',
        'quantity', 'stock_before', 'stock_after', 'note',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function typeLabel(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }
}
