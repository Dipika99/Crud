<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    use RegistersUsers;

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
    }

	public function build()
	{
		return $this->markdown('emails.verify');
	}
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|phone_number|max:15',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'profile_image' => 'nullable',
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
		var_dump($data['profile_image']);
		$uploads = $data['profile_image'];
		$fileHash = str_replace('.' . $uploads->extension(), '', $uploads->hashName());
		$fileName =rand(10,99). time() . '.' . $uploads->getClientOriginalExtension();
		$path = Storage::putFileAs('public/user/', $uploads, $fileName);
        
		$user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'profile_image' => $fileName,
            'password' => bcrypt($data['password']),
            'email_token' => str_random(40),
        ]);
		
		Mail::to($user->email)->send(new EmailVerification($user));
		 
		return $user;
    }
	
	public function verifyEmail($token)
    {
	
        $verifyUser = User::where('email_token', $token)->first();
        if($verifyUser){
            if($verifyUser->status==0) {
				User::where('id', $verifyUser->id)->update([
				'status'=>1,
				]);
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('error', "Sorry your email cannot be identified.");
        }

        return redirect('/login')->with('success', $status);
    }
	
	protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('success', 'We sent you an activation code. Check your email and click on the link to verify.');
    }
}
