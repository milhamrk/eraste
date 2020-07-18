<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'customer_name', 'phone','address'
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo('App\Product', 'id_product', 'id_product');
    }
}