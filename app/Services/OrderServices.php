<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class OrderServices
{
	protected $orderRepository;

	public function __construct(OrderRepository $orderRepository){
		$this->orderRepository = $orderRepository;
	}

	public function saveData($data)
    {
        $result = $this->orderRepository->save($data);
        return $result;
    }

    public function saveOrder($data)
    {
        $result = $this->orderRepository->send($data);
        return $result;
    }

    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete data');
        }
        DB::commit();
        return $order;
    }
    public function getById($id)
    {
        return $this->orderRepository->getById($id);
    }
    public function updateOrder($data, $id)
    {
        DB::beginTransaction();
        try {
         	$order = $this->orderRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to update data');
        }
        DB::commit();
        return $order;
    }
}