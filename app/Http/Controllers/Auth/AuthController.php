<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * field username.
     *
     * @var string
     */
    protected $username = 'sdu_id';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rule = [
            'sdu-id' => 'required|max:20|unique:users,sdu_id',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'firstname' => 'required',
            'lastname' => 'required',
            'tel' => 'required',
        ];

        $ruleStudent = [
            'address' => 'required',
            'birth-day' => 'required',
            'birth-month' => 'required',
            'birth-year' => 'required',
        ];

        if ($data['type'] == 'student')
        {
            $rule = array_merge($rule, $ruleStudent);
            $rule['sdu-id'] .= '|student_id';
        }

        return Validator::make($data, $rule);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $attribute = [
            'type' => $data['type'],
            'sdu_id' => $data['sdu-id'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => 'assets/images/avatars/0'.rand(1, 8).'.png',
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'tel' => $data['tel'],
        ];

        if ($data['type'] == 'student')
        {
            $attributeStudent = [
                'section' => $data['section'],
                'tel_parent' => $data['tel-parent'],
                'address' => $data['address'],
                'birth_date' => Carbon::createFromDate(
                    $data['birth-year'], $data['birth-month'], $data['birth-day']
                ),
            ];

            $attribute = array_merge($attribute, $attributeStudent);
        }
        
        return User::create($attribute);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'sdu_id' => 'required',
            'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }}
