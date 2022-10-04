<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\Role;
use App\Models\SisterConcern;
use App\OrdinaryTrait;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use Session;
use Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    public $libraryEmail;

    use RegistersUsers, OrdinaryTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->libraryEmail = "library@daffodilvarsity.edu.bd";
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm()
    {
        $concerns = SisterConcern::pluck('concernName', 'id');
        return view('auth.register', compact('concerns'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:50',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'member_type' => 'required',
            'sister_concern_id' => 'required_if:member_type,==,Concern'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'displayName' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'member_type' => $data['member_type'],
            'sister_concern_id' => $data['sister_concern_id'],
            'password' => Hash::make($data['password']),
            'verification_code' => str_random(20)
        ]);
    }

    public function register(RegistrationRequest $request)
    {

        try {
            $user = $this->create($request->all());
            $data['email'] = $user['email'];
            $data['displayName'] = $user['displayName'];
            $data['verification_code'] = $user['verification_code'];
            Mail::send('emails.welcome', $data, function ($message) use ($data) {
                $message->from($this->libraryEmail, "e-library,Daffodil International University");
                $message->subject("Welcome to eLibrary, DIU");
                $message->to($data['email']);
            });
            $notification = array(
                'message' => 'Account activation code has been sent to your email, now activate your account!',
                'alert-type' => 'success'
            );
            Session::flash('notification', $notification);
            $this->roleService($request, $user);//set a roles then create some service access
            $this->crateDownloadQuota($user);//create download limits
            return redirect('login');
        } catch (Exception $e) {
            return back();
        }

    }

    public function verify($token)
    {
        //$user = User::with('sisterConcern')->where("verified",0)->where('verification_code',$token)->first()->toArray();
        $user = User::with('sisterConcern')->where("verified", 0)->where('verification_code', $token)->first();
        //dd($user['sisterConcern']);
        if (empty($user)) {
            $notification = array(
                'message' => 'You token is invalid or already verified.',
                'alert-type' => 'success'
            );
            Session::flash('notification', $notification);
            return redirect('login');
        } else {

            User::where('verification_code', $token)->firstOrFail()->verified();
            $data['displayName'] = $user['displayName'];
            $data['email'] = $user['email'];
            $data['verification_code'] = $user['verification_code'];
            $data['profilePic'] = "https://daffodilvarsity.edu.bd/photos/administration/Milton_n.JPG";
            if (!$user['sisterConcern'] == null) {
                $data['concernAuthorityEmail'] = $user['sisterConcern']->concernAuthorityEmail;
                $data['concernName'] = $user['sisterConcern']->concernName;

                //email send to concern or Liberian sir
                Mail::send('emails.activeEmail', $data, function ($message) use ($data) {
                    $message->from($this->libraryEmail, "e-library,Daffodil International University");
                    $message->subject("e-library account activation link");
                    $message->to($data['concernAuthorityEmail']);
                });
            } else {
                $data['concernAuthorityEmail'] = "librarian@daffodilvarsity.edu.bd";
                $data['concernName'] = "";
                //email send to concern or Liberian sir
                Mail::send('emails.activeEmail', $data, function ($message) use ($data) {
                    $message->from($this->libraryEmail, "e-library,Daffodil International University");
                    $message->subject("e-library account guest activation link");
                    $message->to($data['concernAuthorityEmail']);
                });
            }

            //email send to registered user
            Mail::send('emails.verifyEmail', $data, function ($message) use ($data) {
                $message->from($this->libraryEmail, "e-library,Daffodil International University");
                $message->subject("Account is Successfully Verified, e-library, DIU");
                $message->to($data['email']);
            });
            $notification = array(
                'message' => 'Your Request is in under process. Please check your mail to complete
registration.',
                'alert-type' => 'success'
            );
            Session::flash('notification', $notification);
            return redirect('login');
        }
    }

    public function verifyActive($token)
    {
        //dd($token);
        $user = User::with('sisterConcern')->where("verified", 1)->where('verification_code', $token)->first();
        if (empty($user)) {
            $notification = array(
                'message' => 'This account already activated',
                'alert-type' => 'info'
            );
            Session::flash('notification', $notification);
            return redirect('login');
        } else {
            User::where('verification_code', $token)->firstOrFail()->verifiedActive();
            $notification = array(
                'message' => 'elibrary user account activated and send to email account author',
                'alert-type' => 'success'
            );
            $data['email'] = $user['email'];
            $data['displayName'] = $user['displayName'];
            Session::flash('notification', $notification);
            Mail::send('emails.finalActiveEmail', $data, function ($message) use ($data) {
                $message->from($this->libraryEmail, "e-library, DIU");
                $message->subject("Active Your Account, e-library, DIU");
                $message->to($data['email']);
            });

            return redirect('login');
        }

    }

    public function roleService($request, $user)
    {

        if ($request->member_type === "Guest") {
            $user->role()->attach(6);
            $selectedService = Role::findOrFail(6)->service()->pluck('service_id')->toArray();
            $user->service()->attach($selectedService);
        }elseif ($request->member_type==="Concern"){
            $user->role()->attach(7);
            $selectedService = Role::findOrFail(7)->service()->pluck('service_id')->toArray();
            $user->service()->attach($selectedService);
        } else {
            $selectedService = Role::findOrFail(5)->service()->pluck('service_id')->toArray();
            $user->service()->attach($selectedService);
        }
    }
}