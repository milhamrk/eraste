@extends('layouts.home')

@section('content')
<div class="container">
    <h3>Success!</h3>
    <div class="row">
      <div class="col-md-12 table-responsive">
        <table class="table">
          <tr>
            <th>Order No</th>
            <td>{{ $result->id_order }}</td>
          </tr>
          <tr>
            <th>Product Name</th>
            <td>{{ App\Order::find($result->id_order)->product()->first()->product_name }}</td>
          </tr>
          <tr>
            <th>Qty</th>
            <td>1 Pcs</td>
          </tr>
          <tr>
            <th>Total</th>
            <td>Rp {{ number_format(App\Order::find($result->id_order)->product()->first()->price,2) }}</td>
          </tr>
        </table>
      </div>
    </div>
</div>
@endsection
