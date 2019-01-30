<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
	
	public function __construct()
    {
       $this->middleware('auth', ['except' => ['uploadImage']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
		return  view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
       return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request, User $user)
    {
		
		if ($request->file('profile_image')) {
			$uploads = $request->file('profile_image');
			$fileHash = str_replace('.' . $uploads->extension(), '', $uploads->hashName());
			$fileName =rand(10,99). time() . '.' . $uploads->getClientOriginalExtension();
			$path = Storage::putFileAs('public/user/', $uploads, $fileName);
        
		}else{
			$fileName = $request->input('old_profile_image');
		}
	
		if($request->input('password')!=NULL){
			$password = bcrypt($request->input('password'));
		}else{
			$password = $user->password;
		}
		
        $userUpdate = User::where('id',$user->id)
							->update(['first_name'=>$request->input('first_name'),
					            'last_name'=>$request->input('last_name'),
								'phone'=>$request->input('phone'),
								'profile_image' => $fileName,
								'email'=>$request->input('email'),
								'password'=>$password,
					   ]);
		if($userUpdate){
			
			 return redirect()->route('users.index')->with('success', 'Profile updated successfully.');	
			
		}
		return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
	public function uploadImage(Request $request){
	
		if ($request->file('logo'))
		{
		   return "file undu";
		}
		else{
			return "file illla";
		 }
		\Log::info('file data'.json_encode($_FILE));
		
	}
}
