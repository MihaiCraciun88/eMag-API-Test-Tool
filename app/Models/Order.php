<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

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
            $total = round($total + $product->sale_price * ($product->vat + 1), 2);
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
}
