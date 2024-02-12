<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    
    const STATUS_CANCELLED      = 0;
    const STATUS_NEW            = 1;
    const STATUS_IN_PROGRESS    = 2;
    const STATUS_PREPARED       = 3;
    const STATUS_FINALIZED      = 4;
    const STATUS_RETURNED       = 5;

    public $with = ['user', 'customer', 'products', 'attachments'];

    public function user()
    {
        return $this->belongsTo(User::class, 'mkt_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function attachments()
    {
        return $this->hasMany(OrderAttachment::class);
    }

    public function total(): float
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += round($product->sale_price * ($product->vat + 1), 2) * $product->quantity;
        }
        $total = round($total + $this->shipping_tax, 2);
        return $total;
    }

    public function toArray(): array
    {
        $array = parent::toArray();
        if (isset($array['user'])) {
            $array['vendor_name'] = $array['user']['name'];
            unset($array['user']);
        }
        return $array;
    }

    public function getStatusNameAttribute(): string
    {
        switch ((int) $this->status) {
            case self::STATUS_CANCELLED: return 'CANCELLED';
            case self::STATUS_NEW: return 'NEW';
            case self::STATUS_IN_PROGRESS: return 'IN_PROGRESS';
            case self::STATUS_PREPARED: return 'PREPARED';
            case self::STATUS_FINALIZED: return 'FINALIZED';
            case self::STATUS_RETURNED: return 'RETURNED';
        }
        return '';
    }
}
