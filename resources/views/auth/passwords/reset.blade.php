@extends('layouts.login_master')

@section('content')
                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf
                        <h3 class="font-green">Reset Password</h3>
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email"
                                   class="control-label visible-ie8 visible-ie9">{{ __('E-Mail Address') }}</label>


                            <input id="email" placeholder="Email Address" type="email"
                                   class="form-control form-control-solid placeholder-no-fix{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                   class="control-label visible-ie8 visible-ie9">{{ __('Password') }}</label>
                            <input id="password" type="password" placeholder="Password"
                                   class="form-control form-control-solid placeholder-no-fix{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>


                        <div class="form-group row">
                            <label for="password-confirm"
                                   class="control-label visible-ie8 visible-ie9">{{ __('Confirm Password') }}</label>

                            <input id="password-confirm" placeholder="Confirm Password" type="password"
                                   class="form-control form-control-solid placeholder-no-fix {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                   name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>

@endsection
@include('notification.notify')