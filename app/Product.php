<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	protected $primaryKey = 'id_product';
    protected $fillable = [
        'product_name', 'price'
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function order()
    {
        return $this->hasMany('App\Order', 'id_product');
    }
}
