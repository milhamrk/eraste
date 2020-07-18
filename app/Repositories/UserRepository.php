<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository{
	protected $user;

	public function __construct(User $user){
		$this->user = $user;
	}

	public function save($data)
    {
        $user = new $this->user;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        $user->save();

        return $user->fresh();
    }

    public function delete($id)
    {
        $user = $this->user->find($id);
        $user->delete();
        return $user;
    }

    public function getById($id)
    {
        return $this->user
            ->where('id', $id)
            ->first();
    }

    public function update($data, $id)
    {
        
        $user = $this->user->find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->update();
        return $user;
    }
}