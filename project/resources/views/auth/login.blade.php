@extends('auth.layouts.base')

@section('content')


<form class="user" method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
        @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror

        <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." value="{{ old('email') }}" required autocomplete="email" autofocus>
    </div>

    <div class="form-group">
        @error('password')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror

        <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password" required autocomplete="current-password">
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox small">
            <input type="checkbox" class="custom-control-input" id="remember" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="custom-control-label" for="remember">Remember Me</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-user btn-block">
        {{ __('Login') }}
    </button>
</form>
@endsection
