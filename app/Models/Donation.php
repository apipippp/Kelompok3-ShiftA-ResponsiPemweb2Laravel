<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'drop_point_id',
        'tracking_code',
        'donor_name',
        'donor_phone',
        'clothing_type',
        'quantity',
        'condition',
        'photo',
        'delivery_method',
        'status',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dropPoint(): BelongsTo
    {
        return $this->belongsTo(DropPoint::class);
    }

    public function distribution(): HasOne
    {
        return $this->hasOne(Distribution::class);
    }

    public static function generateTrackingCode(): string
    {
        do {
            $code = 'DON-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        } while (static::where('tracking_code', $code)->exists());

        return $code;
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu' => 'Menunggu Verifikasi',
            'diverifikasi' => 'Diverifikasi',
            'diterima' => 'Diterima di Posko',
            'disalurkan' => 'Telah Disalurkan',
            'dibatalkan' => 'Dibatalkan',
            default => ucfirst($this->status),
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'menunggu' => 'bg-amber-100 text-amber-800 border-amber-300',
            'diverifikasi' => 'bg-blue-100 text-blue-800 border-blue-300',
            'diterima' => 'bg-sage/20 text-dark-green border-sage',
            'disalurkan' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'dibatalkan' => 'bg-rose-100 text-rose-800 border-rose-300',
            default => 'bg-gray-100 text-gray-800 border-gray-300',
        };
    }

    public function getConditionLabelAttribute(): string
    {
        return match ($this->condition) {
            'sangat_baik' => 'Sangat Baik (Seperti Baru)',
            'layak_pakai' => 'Layak Pakai (Bersih & Rapi)',
            default => ucfirst($this->condition),
        };
    }

    public function getDeliveryMethodLabelAttribute(): string
    {
        return match ($this->delivery_method) {
            'antar_posko' => 'Antar Langsung ke Posko',
            'ekspedisi' => 'Kirim via Ekspedisi (JNE/J&T/dll)',
            default => ucfirst($this->delivery_method),
        };
    }
}
