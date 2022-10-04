<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\SisterConcern;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected function authenticated(Request $request, $user)
    {

    }
    //protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm()
    {
        $concerns = SisterConcern::pluck('concernName', 'id');
        return view('auth.login', compact('concerns'));
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $validUsername = $this->usernameFormatCheck($request->input('email'));
        switch ($validUsername) {
            case 3:
                $result = $this->employee($request);
                break;
            case 2:
                $result = $this->student($request);
                break;
            default:
                $result = $this->others($request);
        }
        if ($result === true) {
            Auth::user()->update(['loginStatus' => 1]);
            return redirect('/');
        } elseif ($result === 222) {//status not active
            $errors = [$this->username() => trans('auth.status')];
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors($errors);
        } else {
            return $this->sendFailedLoginResponse($request);
        }
    }

    public function employee($request)
    {
        $data['employeeId'] = $request->input('email');
        $data['password'] = $request->input('password');
        $url = "http://auth.diu.edu.bd/auth?clientId=kpiApp&clientSecret=r5ty45ehg56fger45tg4o";
        $data = $this->apiLogin($data, $url);

        if ($data['employeeId'] !== null) {
            $user = User::where('diu_id', $data['employeeId'])->first();
            if ($user == null) {
                $requestData['diu_id'] = $data['employeeId'];
                $requestData['password'] = $this->hasPassword($request->input('password'));


                $user = $this->getEmployeeProfile($requestData);

                $this->userRoleService(3, $user);
                $user = User::where('diu_id', $data['employeeId'])->first();
                $this->setGuard($user);
                return true;
            } else {
                if ($user->status === 0) {
                    return 222;
                } else {
                    $this->setGuard($user);
                    //dd($user->isAdmin);
                    return true;
                }
            }
        } else {
            return false;
        }
    }

    public function getEmployeeProfile($data)
    {
        $url = "http://api.diu.edu.bd/api/v1/employee?employeeId=" . $data['diu_id'] . "&clientId=kpiApp&clientSecret=r5ty45ehg56fger45tg4o";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            )
        );
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        $requestData['diu_id'] = $result['EMPLOYEE_ID'];
        $requestData['displayName'] = $result['NAME'];
        $requestData ['email'] = $result['EMAIL']!=null?$result['EMAIL']:$result['EMPLOYEE_ID'].'@daffodilvarsity.edu.bd';
        $requestData ['mobile'] = $result['MOBILE'];
        $requestData ['deptName'] = $result['DEPT_NAME'];
        $requestData ['designation'] = $result['DESIGNATION'];
        $requestData ['password'] = $data['password'];
        $requestData ['imageBase64'] = null;
        $requestData ['status'] = 1;
        $requestData ['verified'] = 1;
        $requestData ['loginStatus'] = 1;
        $user = User::create($requestData);
        return $user;
    }

    public function getStudentProfile($data)
    {
        $url = "http://api.diu.edu.bd/api/v1/studentDetails?clientId=kpiApp&clientSecret=r5ty45ehg56fger45tg4o&studentId=" . $data['diu_id'];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            )
        );
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        $requestData['diu_id'] = $result['studentId'];
        $requestData['displayName'] = $result['firstName'];
        $requestData ['email'] = $result['email'];
        $requestData ['mobile'] = $result['mobile'];
        $requestData ['deptName'] = $result['departmentName'];
        //$requestData ['designation'] = $result['DESIGNATION'];
        $requestData ['password'] = $data['password'];
        $requestData ['imageBase64'] = $result['studentPhoto'];
        $requestData ['status'] = 1;
        $requestData ['verified'] = 1;
        $requestData ['loginStatus'] = 1;
        $user = User::create($requestData);
        return $user;
    }



    public function setGuard($user)
    {
        $guard = $user->isAdmin == 1 ? 'web' : 'web';
        Auth::guard($guard)->login($user);

    }
    public function student($request)
    {

        $data['studentId'] = $request->input('email');
        $data['password'] = $request->input('password');
        $url = "http://auth.diu.edu.bd/studentAuth?clientId=kpiApp&clientSecret=r5ty45ehg56fger45tg4o";
        $data = $this->apiLogin($data, $url);
        if ($data['status'] === "success") {
            $user = User::where('diu_id', $data['studentId'])->first();
            if ($user == null) {
                $requestData['diu_id'] = $data['studentId'];
                $requestData['password'] = $this->hasPassword($request->input('password'));
                //$user = User::create($requestData);
                $user = $this->getStudentProfile($requestData);
                $this->userRoleService(5, $user);
                $user = User::where('email', $data['email'])->first();
                $this->setGuard($user);
                return true;
            } else {
                if ($user->status === 0) {
                    return 222;
                } else {
                    $this->setGuard($user);
                    return true;
                }
            }
        } else {
            return false;
        }
    }

    public function others($request)
    {
        $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            $user = Auth::user();
            $data['loginStatus'] = 1;
            Auth::user()->update(['loginStatus' => 1]);
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function apiLogin($data, $url)
    {
        $payload = json_encode($data);
// Prepare new cURL resource
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
// Set HTTP Header for POST request
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload))
        );
// Submit the POST request
        $result = curl_exec($ch);
        return json_decode($result, true);
// Close cURL session handle
        //curl_close($ch);
    }

    function usernameFormatCheck($username)
    {
        if (preg_match("/^([0-9]{3}-[0-9]{2}-([0-9]{3}|[0-9]{4}|[0-9]{5}))|(024[0-9]{13})$/", $username)) {
            return 2;
        } elseif (preg_match("/^(71[0-9]{7})|(72[0-9]{7})|74[0-9]{7}$/", $username)) {
            return 3;
        } elseif (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return 1;
        } else {
            return false;
        }
    }

    public function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
            //'verified' => 1,
            'status' => 1,
            //'diu_id' =>null
        ];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];
        // Load user from database
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $errors = [$this->username() => trans('auth.email')];
        }
        if (!User::where('email', $request->email)->where('password', bcrypt($request->password))->first()) {
            $errors = ['password' => trans('auth.password')];
        }
        if ($user && \Hash::check($request->password, $user->password) && $user->status != 1) {
            $errors = [$this->username() => trans('auth.status')];
        }
        /*
                if ($request->expectsJson()) {
                    return response()->json($errors, 422);
                }
        */
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    public function hasPassword($password)
    {
        return Hash::make($password);
    }

    public function userRoleService($role, $user)
    {
        $user->role()->attach($role);
        $selectedService = Role::findOrFail($role)->service()->pluck('service_id')->toArray();
        $user->service()->attach($selectedService);
    }

    public function logout(Request $request)
    {
        Auth::user()->update(['loginStatus' => 0]);
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
