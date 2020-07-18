<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ProductServices
{
	protected $productRepository;

	public function __construct(ProductRepository $productRepository){
		$this->productRepository = $productRepository;
	}

	public function saveData($data)
    {
        $result = $this->productRepository->save($data);
        return $result;
    }

    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete data');
        }
        DB::commit();
        return $product;
    }
    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }
    public function updateProduct($data, $id)
    {
        DB::beginTransaction();
        try {
         	$product = $this->productRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to update data');
        }
        DB::commit();
        return $product;
    }
}