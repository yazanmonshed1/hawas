<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * This trait has all the login throttling functionality.
     */
    use ThrottlesLogins;

    public function __construct()
    {
        $this->middleware('guest:teacher')->only(['showLoginForm', 'login']);
        $this->middleware('auth:teacher')->only('logout');
    }

    public function showLoginForm()
    {
        return view('teacher.auth.login', [
            'title' => 'Teacher Login',
            'loginRoute' => 'teacher.login',
        ]);
    }

    /**
     * Login the teacher.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validator($request);

        //check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)) {
            //Fire the lockout event.
            $this->fireLockoutEvent($request);

            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }

        
        //attempt login.
        if (Auth::guard('teacher')->attempt($request->only('username', 'password'), $request->filled('remember'))) {
            //Authenticated
            return redirect()
                ->intended(route('teacher.home'))
                ->with('status', 'You are Logged in as Teacher!');
        }

        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);

        //Authentication failed
        return $this->loginFailed();
    }

    /**
     * Logout the teacher.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('teacher')->logout();
        return redirect()
            ->route('teacher.login')
            ->with('status', 'Teacher has been logged out!');
    }

    /**
     * Validate the form data.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    private function validator(Request $request)
    {
        $rules = [
            'username'    => 'required|exists:teachers|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        $messages = [
            'username.exists' => 'These credentials do not match our records.',
        ];

        $request->validate($rules, $messages);
    }

    /**
     * Redirect back after a failed login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Login failed, please try again!');
    }

    protected function username()
    {
        return 'username';
    }
}
