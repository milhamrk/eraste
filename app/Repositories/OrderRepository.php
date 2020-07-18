<?php

namespace App\Repositories;

use App\Order;

class OrderRepository{
	protected $order;

	public function __construct(Order $order){
		$this->order = $order;
	}

    public function delete($id)
    {
        $order = $this->order->find($id);
        $order->delete();
        return $order;
    }

    public function getById($id)
    {
        return $this->order
            ->where('id_Order', $id)
            ->first();
    }

    public function send($data)
    {
        $order = new $this->order;

        $order->customer_name = $data['name'];
        $order->phone = $data['phone'];
        $order->id_product = $data['id'];
        $order->address = $data['address'];

        $order->save();

        return $order->fresh();
    }

    public function update($data, $id)
    {
        
        $order = $this->order->find($id);
        $order->customer_name = $data['name'];
        $order->phone = $data['phone'];
        $order->address = $data['address'];
        $order->update();
        return $order;
    }
}