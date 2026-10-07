<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    public const TYPES = [
        'dine_in'  => 'Makan di tempat',
        'pickup'   => 'Ambil sendiri',
        'delivery' => 'Antar ke alamat',
    ];

    public const STATUSES = [
        'pending'    => 'Menunggu',
        'processing' => 'Diproses',
        'ready'      => 'Siap',
        'completed'  => 'Selesai',
        'cancelled'  => 'Dibatalkan',
    ];

    public const STATUS_COLORS = [
        'pending'    => 'gray',
        'processing' => 'warning',
        'ready'      => 'info',
        'completed'  => 'success',
        'cancelled'  => 'danger',
    ];

    public const PAYMENT_STATUSES = [
        'unpaid' => 'Belum dibayar',
        'paid'   => 'Lunas',
    ];

    protected $fillable = [
        'user_id', 'customer_name', 'customer_phone', 'type', 'table_number',
        'delivery_address', 'notes', 'subtotal', 'delivery_fee', 'total',
        'status', 'payment_status', 'payment_method',
    ];

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            $order->uuid ??= (string) Str::uuid();

            do {
                $number = 'CR-' . now()->format('ymd') . '-' . strtoupper(Str::random(4));
            } while (static::where('order_number', $number)->exists());

            $order->order_number ??= $number;
        });

        // Pesanan dibatalkan: stok yang tadi dikurangi dikembalikan otomatis.
        static::updated(function (Order $order) {
            if ($order->wasChanged('status') && $order->status === 'cancelled') {
                app(\App\Services\StockService::class)->restoreForOrder($order);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function typeLabel(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    /** Pesanan yang sudah selesai atau dibatalkan tidak akan berubah lagi. */
    public function isFinal(): bool
    {
        return in_array($this->status, ['completed', 'cancelled'], true);
    }

    /** Langkah yang ditampilkan di halaman lacak. Nama langkah "ready" menyesuaikan tipe pesanan. */
    public function trackingSteps(): array
    {
        $ready = match ($this->type) {
            'delivery' => 'Dalam pengantaran',
            'pickup'   => 'Siap diambil',
            default    => 'Siap disajikan',
        };

        return [
            'pending'    => 'Pesanan diterima',
            'processing' => 'Sedang disiapkan',
            'ready'      => $ready,
            'completed'  => 'Selesai',
        ];
    }

    public function currentStepIndex(): int
    {
        $index = array_search($this->status, array_keys($this->trackingSteps()), true);

        return $index === false ? 0 : $index;
    }

    public function statusMessage(): string
    {
        return match ($this->status) {
            'pending'    => 'Pesanan Anda sudah kami terima dan sedang menunggu konfirmasi.',
            'processing' => 'Pesanan Anda sedang kami siapkan.',
            'ready'      => match ($this->type) {
                'delivery' => 'Pesanan Anda sedang dalam pengantaran ke alamat Anda.',
                'pickup'   => 'Pesanan Anda sudah siap. Silakan ambil di kasir.',
                default    => 'Pesanan Anda sudah siap dan segera disajikan di meja Anda.',
            },
            'completed'  => 'Pesanan selesai. Terima kasih sudah memesan!',
            'cancelled'  => 'Pesanan ini dibatalkan. Hubungi kami kalau ada pertanyaan.',
            default      => '',
        };
    }
}
