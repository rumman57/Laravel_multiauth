<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Auth;

class AdminLoginController extends Controller
{
	public function __construct(){
		$this->middleware('guest:admin',['except' => ['logout']]);
	}

	           /*********Admin Login*********/

    public function showLoginForm(){
    	return view('auth.admin-login');
    }

    public function login(Request $request){
    	 // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('admin.dashboard'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }

       /*********Admin Register**********/
    
    public function showRegistrationForm(){
    	return view('auth.admin-register');
    }
    
    public function register(Request $request){
    	 // Validate the form data
      $this->validate($request, [
         'name'    =>  'required|alpha|max:100|min:4',
    	 'email'   => 'required|email',
    	 'password' =>  'required|confirmed',
    	 'password_confirmation' => 'sometimes|required_with:password',
    	 'jbtle'   => 'required'
      ]);
      
      $admin = new Admin();

      $admin->name = $request->name;
      $admin->email = $request->email;
      $admin->password = bcrypt($request->password);
      $admin->role_title = $request->jbtle;
      $admin->save();
      return redirect()->route('admin.login');
     
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
