<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreUser;

class UserController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('auth');	
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
        $userUpdate = User::where('id',$user->id)
							->update(['first_name'=>$request->input('first_name'),
					            'last_name'=>$request->input('last_name'),
								'phone'=>$request->input('phone'),
								'profile_image'=>$request->input('profile_image'),
								'email'=>$request->input('email'),
								'password'=>$request->input('password'),
					   ]);
		if($companyUpdate){
			//return redirect()->route('user.index',["company"=>$company->id])
			//->with('success','Profile updated successfully');
		}
		return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
			$userDelete = User::find($user->id);
			if($userDelete->delete()){
				return redirect()->route('user.index')
				->with('success','User deleted successfully');
		}
		return back()->withInput()->with('error','Company could not be deleted');
		
    }
}
