<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Services\ProductServices;
use App\Http\Requests\ProductRequest;
use DataTables;
use Exception;

class ProductController extends Controller
{
    protected $productServices;
    public function __construct(ProductServices $productServices)
    {
        $this->middleware('auth');
        $this->productServices = $productServices;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="'.route('product.edit', $row->id_product).'">Edit</a> | <a href="javascript:void(0)" class="btn-delete" data-id='.route('product.destroy', $row->id_product).'>Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('product.index');
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(ProductRequest $request)
    {
        $result = ['status' => 200];

        try{
            $result = $this->productServices->saveData($request->all());
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        if(@$result['error']==null){
            $message = "Your product was successfully added";
            return redirect()->route('product')->withSuccess($message);
        }else{
            $message = "Your product failed to added (".$result['error'].")";
            return redirect()->route('product')->withFail($message);
        }
    }
    
    public function edit($id)
    {
        
        $result = ['status' => 200];

        try {
            $result['data'] = $this->productServices->getById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        if($result['status']==200 && $result['data']){
             return view('product.create', compact('result'));
        }else{
            $message = "You must select correct product";
            return redirect()->route('product')->withFail($message);
        }
    }

    public function update(ProductRequest $request, $id)
    {
        $result = ['status' => 200];
        try {
            $result['data'] = $this->productServices->updateProduct($request, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        if(@$result['error']==null){
             $message = "Product updated successfully";
            return redirect()->route('product')->withSuccess($message);
        }else{
            $message = "Error: ".$result['error'];
            return redirect()->route('product')->withFail($message);
        }
    }

    public function destroy($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->productServices->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    }
}
