<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserServices
{
	protected $userRepository;

	public function __construct(UserRepository $userRepository){
		$this->userRepository = $userRepository;
	}

	public function saveData($data)
    {
        $result = $this->userRepository->save($data);
        return $result;
    }

    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete data');
        }
        DB::commit();
        return $user;
    }
    public function getById($id)
    {
        return $this->userRepository->getById($id);
    }
    public function updateUser($data, $id)
    {
        DB::beginTransaction();
        try {
         	$user = $this->userRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to update data');
        }
        DB::commit();
        return $user;
    }
}