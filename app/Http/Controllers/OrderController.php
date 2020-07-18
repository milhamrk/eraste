<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\OrderServices;
use App\Http\Requests\OrderRequest;
use DataTables;
use Exception;

class OrderController extends Controller
{
    protected $orderServices;
    public function __construct(OrderServices $orderServices)
    {
        $this->middleware('auth');
        $this->orderServices = $orderServices;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::latest()->get();
            $query = Order::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('order.edit', $row->id_order).'">Edit</a> | <a href="javascript:void(0)" class="btn-delete" data-id="'.route('order.destroy', $row->id_order).'">Delete</a>';
                            return $btn;
                    })
                    ->addColumn('product_name', function($query){
                           $btn = @Order::find($query->id_order)->product()->first()->product_name;
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('order.index');
    }

    public function edit($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->orderServices->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        if(@$result['error']==null){
             return view('order.create', compact('result'));
        }else{
            $message = "You must select correct order";
            return redirect()->route('order')->withFail($message);
        }
    }

    public function update(OrderRequest $request, $id)
    {
        $result = ['status' => 200];
        try {
            $result['data'] = $this->orderServices->updateOrder($request, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        if(@$result['error']==null){
             $message = "Order updated successfully";
            return redirect()->route('order')->withSuccess($message);
        }else{
            $message = "Error: ".$result['error'];
            return redirect()->route('order')->withFail($message);
        }
    }

    public function destroy($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->orderServices->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }
}
