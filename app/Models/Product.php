<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'image', 'is_available', 'is_featured',
        'low_stock_threshold',
        // 'stock' sengaja tidak mass-assignable: ubah lewat StockService supaya tercatat di riwayat.
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_featured'  => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    /** Stok 0 = habis. Berlaku otomatis, terpisah dari saklar manual is_available. */
    public function isSoldOut(): bool
    {
        return (int) $this->stock <= 0;
    }

    public function isLowStock(): bool
    {
        return $this->stock > 0 && $this->stock <= $this->low_stock_threshold;
    }

    /** 'out' | 'low' | 'ok' */
    public function stockStatus(): string
    {
        return match (true) {
            $this->isSoldOut()  => 'out',
            $this->isLowStock() => 'low',
            default             => 'ok',
        };
    }

    /** Menu yang stoknya menipis atau sudah habis. */
    public function scopeNeedsRestock(Builder $query): void
    {
        $query->whereColumn('stock', '<=', 'low_stock_threshold');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
