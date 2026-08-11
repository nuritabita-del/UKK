<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "order_number", "delivery_method", "recipient_name", "phone",
        "address", "notes", "subtotal", "shipping_cost", "total", "status",
        "payment_method", "payment_status", "payment_proof", "payment_verified_at",
    ];

    protected $casts = [
        "payment_verified_at" => "datetime",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public static function generateOrderNumber(): string
    {
        return "CKS-" . now()->format("Ymd") . "-" . strtoupper(uniqid());
    }

    // Status pembayaran yang dipakai di alur QRIS manual:
    // pending              -> belum upload bukti pembayaran
    // menunggu_verifikasi  -> bukti sudah diupload, menunggu di-ACC admin
    // paid                 -> sudah di-ACC admin
    // ditolak              -> bukti ditolak admin, customer perlu upload ulang
    public const PAYMENT_PENDING = "pending";
    public const PAYMENT_WAITING_VERIFICATION = "menunggu_verifikasi";
    public const PAYMENT_PAID = "paid";
    public const PAYMENT_REJECTED = "ditolak";

    public function isAwaitingProof(): bool
    {
        return in_array($this->payment_status, [self::PAYMENT_PENDING, self::PAYMENT_REJECTED]);
    }

    public function isAwaitingVerification(): bool
    {
        return $this->payment_status === self::PAYMENT_WAITING_VERIFICATION;
    }

    public function isPaid(): bool
    {
        return $this->payment_status === self::PAYMENT_PAID;
    }
}
