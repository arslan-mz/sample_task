@extends('layouts.main')
@section('main-section')
<div class="text-center">
    <h2>User Login</h2>
</div>
<div class="row">
    <div class="offset-md-4 col-md-6">
        <form action="{{url('/login')}}/" method="POST">
            @csrf
            <div class="mb-3 col-9 col-md-9 col-lg-6">
                <label for="user_id" class="form-label">Your Email ID *</label>
                <input type="text" name="email" value="{{old('user')}}" class="form-control" id="user_id" required>
                <span class="text-danger">
                  @error('user')
                  {{$message}}
                  @enderror
                </span>
            </div>

            <div class="mb-3 col-9 col-md-9 col-lg-6">
                <label for="password" class="form-label">Password *</label>
                <input type="password" name="pwd" class="form-control" id="password" required>
                <span class="text-danger">
                  @error('pwd')
                  {{$message}}
                  @enderror
                </span>
            </div>

            
                <button type="submit" class="btn btn-primary">Login</button>
            

            @if(session('message'))
            <div class="alert alert-{{session('alert-type')}} mb-3 col-9 col-md-9 col-lg-6 mrg-t-30 mrg-rl-auto hidden" id="alert" role ="alert">
              {{session('message')}}
            </div>
            @endif
        </form>
    </div>
</div>
@endsection