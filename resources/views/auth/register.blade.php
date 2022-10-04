@extends('layouts.login_master')
@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h3 class="font-green">Sign Up</h3>
        <p class="hint"> Enter your personal details below: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Name</label>
            <input id="name" type="text" placeholder="Name"
                   class="form-control placeholder-no-fix {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                   value="{{ old('name') }}" required autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input id="email" placeholder="Email" type="email"
                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                   value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Member Type</label>
            {!! Form::select('member_type', ['Concern'=>'Concern member','Guest'=>'Guest'], null, ['placeholder' => 'Please select member type', 'class' => 'form-control','onchange'=>'java_script_:show(this.options[this.selectedIndex].value)']) !!}
            {!! $errors->first('member_type', '<p class="invalid-feedback"><strong>:message</strong></p>') !!}
        </div>
        <div class="form-group" id="sister_concern_id">
            <label class="control-label visible-ie8 visible-ie9">Concern Name</label>
            {!! Form::select('sister_concern_id', $concerns, null, ['placeholder' => 'Please select ...', 'class' => 'form-control']) !!}
            {!! $errors->first('sister_concern_id', '<p class="invalid-feedback">:message</p>') !!}
        </div>
        <p class="hint"> Enter your account details below: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input id="username" type="text" placeholder="Username"
                   class="form-control placeholder-no-fix {{ $errors->has('username') ? ' is-invalid' : '' }}"
                   name="username" value="{{ old('username') }}" autofocus>
            @if ($errors->has('username'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input id="password" type="password" autocomplete="off" placeholder="Your Password"
                   class="form-control placeholder-no-fix{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password">
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <input id="password-confirm" autocomplete="off" placeholder="Re-type Your Password" type="password"
                   class="form-control" name="password_confirmation">
        </div>
        <div class="form-actions">
           <button type="submit" id="register-submit-btn" class="btn btn-success login-button">Submit</button>
        </div>
        <div class="create-account">
            <p>
                <a href="{{ url('login')}}" id="register-back-btn" >Back to Login</a>
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
@include('notification.notify')
@push('styles')
    <style>
        .login-button{width: 100%}
        .create-account p a{width: 80%; text-align: left; line-height: 25px}
    </style>
@endpush
@push('scripts')
    <script type="text/javascript">
        function show(concern) {
            if (concern == "Concern") {
                sister_concern_id.style.display = 'inline-block';
                Form.fileURL.focus();
            }
            else {
                sister_concern_id.style.display = 'none';
            }
        }
    </script>
@endpush