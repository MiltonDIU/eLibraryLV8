@extends('layouts.login_master')

@section('content')

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <h3 class="font-green">Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group">
            <input id="email" type="email" placeholder="Email"
                   class="form-control placeholder-no-fix {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                   value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-actions">
            <button type="submit"
                    class="btn btn-success uppercase  login-button">{{ __('Send Password Reset Link') }}</button>


        </div>
        <div class="create-account">
            <p>    <a href="{{url('login')}}" > Back to Login</a></p>
        </div>
    </form>
@endsection

@push('styles')
    <style>
        .login-button{width: 100%}
        .create-account p a{width: 80%; text-align: left; line-height: 25px}
    </style>
@endpush
@include('notification.notify')