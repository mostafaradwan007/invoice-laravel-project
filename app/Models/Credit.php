<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'status',
        'number',
        'client_id',
        'amount',
        'total_amount',
        'partial_deposit',
        'discount',
        'discount_type',
        'date',
        'valid_until',
        'po_number',
        'public_notes',
        'private_notes',
        'terms',
        'footer',
        'items', // JSON products/tasks
    ];

   
    protected $casts = [
         
        'amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'valid_until' => 'date',
        'date' => 'date',
        'items' => 'array', // decode JSON
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

   
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($credit) {
            if (empty($credit->number)) {
                $credit->number = 'QT-' . date('Y') . '-' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

   
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'draft' => 'bg-secondary',
            'sent' => 'bg-primary',
            'accepted' => 'bg-success',
            'rejected' => 'bg-danger',
            'expired' => 'bg-warning',
            default => 'bg-secondary'
        };
    }

    public function getIsExpiredAttribute()
    {
        return $this->valid_until && $this->valid_until->isPast();
    }

    
    public function getFormattedTotalAmountAttribute()
    {
        return '$' . number_format($this->total_amount, 2);
    }
}
