@extends('layouts.login_master')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        <p style="color: red;"><span style="font-size: 20px">Note: </span>If you are a student/employee of Daffodil International University then there is no need registration in this system, you just log in through your ID and password from student portal or employee ID and password from ERP and click to the login button and access all services what you need of e-Library.</p>
        @csrf
        <h3 class="form-title font-green">Sign In</h3>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input id="email" type="text" autocomplete="off" placeholder="Email or Student/Employee ID"
                   class="form-control form-control-solid placeholder-no-fix {{ $errors->has('email') ? ' is-invalid' : '' }}"
                   name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
            @endif
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input id="password" type="password" autocomplete="off" placeholder="Password"
                   class="form-control form-control-solid placeholder-no-fix {{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
        </div>


        <div class="form-actions">
            <button type="submit" class="btn green uppercase login-button">Login</button>


        </div>
        <div class="create-account">
            <p>
                <a href="{{url('register')}}" id="register-btn" >Create new account</a>

            <a  href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            <br>
            <a  target="_blank" href="https://drive.google.com/file/d/1RjnFCJkMEeH1M261a7HDg4tqIHT51RVx/view?usp=sharing">
                {{ __('Login Tutorial') }}
            </a>
            <a href="#" data-toggle="modal" data-target="#registration">Registration Tutorials</a>
            </p>
        </div>
    </form>





    <!-- Modal -->
    <div class="modal fade" id="registration" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <h3 style="text-align: center"> Sign in process for Student’s/Employee of DIU</h3>
<p>
    If you are a student/employee of Daffodil International University then there is no need
    registration in this system, you just log in through your id and password of student
    portal/employee id and password of ERP and click to the login button and access all services
    what you need of e-Library.
</p>
<p style="color: red; ">
    Without Students/Employee of Daffodil International
    University all, you need to create an account and submit the
    registration process.
</p>
<hr>
                    <h3>The registration process for Daffodil Family Members</h3>
<p>
    If you are a member of the Daffodil family then you
    need to create an account and submit the registration
    process.
</p>

                    <h4>Just follow these 10 steps and login successfully !!!</h4>
              <ol>
                  <li>Open the registration form (Click to New Account)</li>
                  <li>Enter your details in the designated box.</li>
                  <li>Select “concern member” in the member type box.</li>
                  <li>Select your Concern carefully.</li>
                  <li>Chose an appropriate display name and a secure password</li>
                  <li>All field are complete then click Submit</li>
                  <li>Check your email (Which you gave at the time of registration) and verify your email</li>
                  <li>Your organization&#39;s head or responsible person will receive an email, this
                      person confirming that you can log in our system</li>
                  <li>Once he confirms, a notification will come to your email, after which you
                      will get all access to the e-library.</li>
                  <li>Now you log in with your email address and password.</li>
              </ol>
                    <hr>
                   <h3> The registration process for Outsider of Daffodil Family
                   </h3>
                   <span style="color: red; text-align: center"> If you log in as a guest</span>

                   <h4> Then follow these steps and login successfully !!!</h4>
                    <ol>
                        <li>Open the registration form (Click to New Account)</li>
                        <li>Enter your details in the designated box.</li>
                        <li>Select “Guest” in the member type box.</li>
                        <li>Chose an appropriate display name and a secure password</li>
                        <li>All field are complete then click Submit</li>
                        <li>Check your email (Which you gave at the time of registration) and verify your email</li>
                        <li>After your verification, the library person will receive a notification, this person
                            confirming that you can log in our system</li>
                        <li>Once he confirms, a notification will come to your email, after which you
                            will get all access to the e-library.</li>
                        <li>Now you log in with your email address and password (Which you gave at the time of
                            registration)</li>
                    </ol>
                    <hr>
                    <p>
                        (N.B- When you submit then check your mail which you use there and click to
                        activation link and wait to admin approval. When an admin approves your
                        request then another mail will come that your user is active).
                        <br>
                        <span style="color: red">
                             If you notice that no
                        email has been sent to your email inbox, check the spam box
                        </span>
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('styles')
<style>
    .login-button{width: 100%}
    .create-account p a{width: 80%; text-align: left; line-height: 25px}
</style>
    @endpush
@include('notification.notify')