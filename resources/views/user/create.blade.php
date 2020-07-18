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
                    <form method="POST" action="{{ (@$result) ? route('user.update', $result['data']->id) : route('user.store') }}">
                        @csrf
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ (@$result) ? $result['data']->name : old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ (@$result) ? $result['data']->email : old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      @if(@!$result)
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="password">Password Confirmation</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                      </div>
                      @endif
                      <button type="submit" class="btn btn-success btn-block">Save</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
