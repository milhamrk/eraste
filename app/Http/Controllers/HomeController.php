<?php

namespace App\Http\Controllers;
use App\Product;
use App\Services\ProductServices;
use App\Services\OrderServices;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productServices;
    protected $orderServices;
    public function __construct(ProductServices $productServices, OrderServices $orderServices)
    {
        $this->productServices = $productServices;
        $this->orderServices = $orderServices;
    }

    public function index()
    {
        $produk = Product::all();
        return view('produk', compact('produk'));
    }

    public function form($id)
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
             return view('form', compact('result'));
        }else{
            $message = "You must select correct product";
            return redirect()->route('home')->withFail($message);
        }
    }

    public function success(OrderRequest $request)
    {
        $result = ['status' => 200];

        try{
            $result = $this->orderServices->saveOrder($request->all());
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        if(@$result['error']==null){
            return view('success', compact('result'));
        }else{
            $message = "Your product failed to added (".$result['error'].")";
            return redirect()->route('beli')->withFail($message);
        }
    }
}
