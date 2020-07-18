@extends('layouts.home')

@section('content')
<div class="container">
    <h3>Produk</h3>
    <div class="row justify-content-center">
        <div class="card-deck">
          @php $no=-1; @endphp
          @foreach($produk as $product)
          @php
          $no++;
          @endphp
          @if($no%4==0)
          </div><div class="card-deck">
          @endif
          <div class="card py-3 col-md-6">
            <img class="card-img-top" src="/images/product.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $product->product_name }}</h5>
                <p class="card-text">Rp {{ number_format($product->price,2) }}</p>
                <a href="{{ route('beli',$product->id_product) }}" class="btn btn-success btn-block">Beli</a>
              </div>
          </div>
          @endforeach
        </div>
    </div>
</div>
@endsection

