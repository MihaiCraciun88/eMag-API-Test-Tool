<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    public function getProductIdAttribute()
    {
        return $this->id;  
    }

    public function toArray()
    {
        $array = parent::toArray();
        if (isset($array['pivot'])) {
            $array['product_id'] = $array['pivot']['product_id'];
            $array['quantity'] = $array['pivot']['quantity'];
            unset($array['pivot']);
        }
        return $array;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'mkt_id', 'id');
    }
}
