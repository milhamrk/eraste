<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\UserServices;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use DataTables;
use Exception;

class UserController extends Controller
{
    protected $userServices;
    public function __construct(UserServices $userServices)
    {
        $this->middleware('auth');
        $this->userServices = $userServices;
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('user.edit', $row->id).'">Edit</a> | <a href="javascript:void(0)" class="btn-delete" data-id='.route('user.destroy', $row->id).'>Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('user.index');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserRequest $request)
    {
        $result = ['status' => 200];

        try{
            $result = $this->userServices->saveData($request->all());
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        if(@$result['error']==null){
            $message = "Your user was successfully added";
            return redirect()->route('user')->withSuccess($message);
        }else{
            $message = "Your user failed to added (".$result['error'].")";
            return redirect()->route('user')->withFail($message);
        }
    }

    public function edit($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->userServices->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        if(@$result['error']==null){
             return view('user.create', compact('result'));
        }else{
            $message = "You must select correct user";
            return redirect()->route('user')->withFail($message);
        }
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $result = ['status' => 200];
        try {
            $result['data'] = $this->userServices->updateUser($request, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        if(@$result['error']==null){
             $message = "User updated successfully";
            return redirect()->route('user')->withSuccess($message);
        }else{
            $message = "Error: ".$result['error'];
            return redirect()->route('user')->withFail($message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->userServices->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }
}
