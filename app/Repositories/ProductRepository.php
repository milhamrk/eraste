<?php

namespace App\Repositories;

use App\Product;

class ProductRepository{
	protected $product;

	public function __construct(Product $product){
		$this->product = $product;
	}

	public function save($data)
    {
        $product = new $this->product;

        $product->product_name = $data['name'];
        $product->price = $data['price'];

        $product->save();

        return $product->fresh();
    }

    public function delete($id)
    {
        $product = $this->product->find($id);
        $product->delete();
        return $product;
    }

    public function getById($id)
    {
        return $this->product
            ->where('id_product', $id)
            ->first();
    }

    public function update($data, $id)
    {
        
        $product = $this->product->find($id);
        $product->product_name = $data['name'];
        $product->price = $data['price'];
        $product->update();
        return $product;
    }
}