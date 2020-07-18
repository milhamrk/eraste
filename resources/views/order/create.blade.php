@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Update Form</div>

                <div class="card-body px-4">
                    <form method="POST" action="{{ route('order.update',$result['data']->id_order) }}">
                        @csrf
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ (@$result) ? $result['data']->customer_name : old('name') }}" autocomplete="off" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ (@$result) ? $result['data']->phone : old('phone') }}" required autocomplete="current-phone">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="current-address">{{ (@$result) ? $result['data']->address : old('address') }}</textarea>
                        @error('address')
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
