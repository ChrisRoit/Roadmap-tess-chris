<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class UsersResourceController extends UsersController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy("id","DESC")->paginate(10);
        return $this->validateAdmin(view("admin_user_management.overview")->with("user",Auth::user())->with("users",$users));
        //
        //return view("admin_user_management.overview")->with("user",Auth::user());
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
        if(!Auth::user()){
            throw new Exception("User not logged in.");
        }

        if(Auth::user()->is_admin){
            if($this->validateInputs($request)){
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = hash::make($request->pw);
                $user->is_admin = $request->userType == "admin" ? 1 : 0;
                $user->is_operator = $request->userType == "operator" ? 1 : 0;
                $user->save();
                return 1;
            }
        }
        return 0;
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!Auth::user()){
            throw new Exception("No user logged in.");
        }
        if(!Auth::user()->is_admin){
            throw new Exception("This user does not have permission to use this functionality.");
        }
        //
        if($request->id){
            $user = User::where("id","=","$request->id")->first();
            if(isset($user)){
                $user->name = $request->username;
                if($this->validateEmail($request->email)){
                    $user->email = $request->email;
                }else{
                    throw new Exception("Email format is invalid.");
                }
                if($request->pw > 0){
                    if($this->validatePassword($request->pw)){
                        $user->password = Hash::make($request->pw);
                    }
                    else{
                        throw new Exception("Password must be of length 8 or more.");
                    }
                }
                if($this->validateUserType($request->userType)){
                    $user->is_admin = $request->userType == "admin" ? 1 : 0;
                    $user->is_operator = $request->userType == "operator" ? 1 : 0;
                }else{
                    throw new Exception("Invalid user type!");
                }
                $user->save();
                return response()->json(["message" => "User updated"]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(!Auth::user()){
            throw new Exception("No user logged in.");
        }
        if(!Auth::user()->is_admin){
            throw new Exception("This user does not have permission to use this functionality.");
        }
        //
        if($request->id){
            $user = User::where("id","=","$request->id")->first();
            if(isset($user)){
                $user->delete();
                return response()->json(["message" => "User deleted!"]);
            }
            throw new Exception("No such users exists!");
        }
    }
}
