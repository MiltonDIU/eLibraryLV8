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
            <a href="#" data-toggle="modal" data-target="#tearms">Terms and Condition</a>
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
{{--terms and condition--}}
    <div class="modal fade" id="tearms" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                   <h1> E-Resources: Copyright and Terms & Conditions</h1>
<p>
    Copyright laws govern the making of photocopies and other reproductions of copyrighted materials,
    such as making copies of print or electronic articles for others. DIU Library users must follow
    international copyright laws and the specific terms of database providers regarding the storage and
    transmission of electronic information.
</p>

                    <h3 style="font-size: 18px; color: #0c91e5">Consequences of Misuse of Electronic Resources</h3>
                    <ul>
                        <li>Electronic resource providers are constantly monitoring overall account activity</li>
                        <li>A serious violation is detected coming from our campus or one of our remote users</li>
                        <li>Providers reserve the right to immediately suspend access to their eResource for the entire
                            campus</li>
                        <li>The library may be notified of the suspension of service and investigate the situation</li>
                        <li>Misuse and disregard for terms and conditions of use put at risk the library</li>
                    </ul>
            <p>

                DIU Library subscribes to licensed electronic resources, such as databases, journals, and books, in
                support of the educational and research needs of the DIU community. Access and use of our
                electronic resources are governed by both copyright law and license agreements that control who
                can use these materials as well as how they can be used.
                Authorized Users are limited to members of the campus community (faculty, staff, and enrolled
                students) as well as on-site walk-in users. These materials are licensed for nonprofit educational,
                research, and/or scholarly purposes. <strong>Specifically, sharing your password or using the materials
                    for commercial purposes is strictly prohibited.</strong>
            </p>
                    <h5 style="font-size: 18px; color: #ae27e7">You may allow</h5>
                    <ul>
                        <li>DIU users allow access to archives using their User ID and Password</li>
                        <li>DIU users allow downloading 50 books and other resources not restricted</li>
                        <li>The limit of download may be increased on your using explanation</li>
                        <li>Feedback/suggestion may be allowed for further development</li>
                        <li>DIU users' continued access to electronic resources</li>
                    </ul>

                    <h5 style="font-size: 18px; color: #ae27e7">You may not allow</h5>
                    <p>
                        Permit anyone other than another Authorized User to use the licensed materials but not through
                        your access.
                    </p>
                    <ul>
                        <li>Restricted to share a user ID and password to others</li>
                        <li>Access to e-resources has been shut off for violations of 100-500 articles
                            downloaded in one session;</li>
                        <li>Modify or create a derivative work of licensed content or remove, obscure or
                            modify any copyright or other notices;</li>
                        <li>Use the licensed materials for commercial purposes, including, but not limited to, the sale
                            of the licensed materials;</li>
                        <li>Upload any licensed materials to an open website, including social networking sites;</li>
                        <li>Engage in systematic downloading, distributing, or retaining substantial portions of
                            the licensed materials;</li>
                    </ul>
                    <p>Engage in text mining without prior permission.
                        Violation of these terms jeopardizes campus access and exposes violators to disciplinary
                        actions. The use of these resources indicates your awareness and compliance with licensing
                        terms and conditions.</p>
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