@extends('layouts.home')

@section('content')
<div class="container">
    <h3>Order Information</h3>
    <div class="row">
      <div class="col-md-12">
        <p><b>{{ $result['data']->product_name }}</b></p>
        <p>Rp {{ number_format($result['data']->price,2) }}</p>
        <p>Qty 1 pcs</p>
        <h3>Customer Information</h3>
        <form method="POST" action="{{ route('success') }}">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $result['data']->id_product }}">
          <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
          </div>
          @error('name')
              <span class="invalid-feedback" role="alert" style="display:block;">
                  <strong>{{ $message }}asd</strong>
              </span>
          @enderror
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="08">
          </div>
          @error('phone')
              <span class="invalid-feedback" role="alert" style="display:block;">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
          <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" rows="9" placeholder="Enter your address"></textarea>
          </div>
          @error('address')
              <span class="invalid-feedback" role="alert" style="display:block;">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
          <button type="submit" class="btn btn-success btn-block">Beli</button>
        </form>
      </div>
    </div>
</div>
@endsection
