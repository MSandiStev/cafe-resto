<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'title', 'badge', 'description', 'product_id',
        'starts_on', 'ends_on', 'is_active',
    ];

    protected $casts = [
        'starts_on' => 'date',
        'ends_on' => 'date',
        'is_active' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /** Promo aktif yang tanggalnya mencakup hari ini (WIB). */
    public function scopeRunning(Builder $query): Builder
    {
        $today = now('Asia/Jakarta')->toDateString();

        return $query->where('is_active', true)
            ->where(fn ($q) => $q->whereNull('starts_on')->orWhereDate('starts_on', '<=', $today))
            ->where(fn ($q) => $q->whereNull('ends_on')->orWhereDate('ends_on', '>=', $today));
    }
}
