@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ (@$result) ? 'Update' : 'Create' }} Form</div>

                <div class="card-body px-4">
                    <form method="POST" action="{{ (@$result) ? route('product.update', $result['data']->id_product) : route('product.store') }}">
                        @csrf
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ (@$result) ? $result['data']->product_name : old('name') }}" autocomplete="off" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" value="{{ (@$result) ? $result['data']->price : old('price') }}" name="price" autocomplete="off">
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-success btn-block">Save</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
