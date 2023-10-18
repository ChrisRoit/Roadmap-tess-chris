<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;


class UsersController extends Controller
{


    public function getUsersData(){
        if(!Auth::user()){
            throw new Exception("User is not logged in.");
        }
        if(!Auth::user()->is_admin){
            throw new Exception("User is not an admin."); 
        }
        return response()->json(User::orderBy("id","DESC")->paginate(10));
    }

    public function validatePassword($password){
        if(strlen($password) >= 8){
            return true;
        }
        return false;
    }

    public function validateEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    public function validateUserType($userType){
        if(isset($userType)){
            if($userType == "admin" || $userType == "operator" || $userType == "user"){
                return true;
            }
        }
        return false;
    }

    public function validateInputs(Request $request){
        if($this->validateEmail($request->email) && $this->validatePassword($request->pw)){
            return true;
        }
        return false;
    }

    /**
     * method that validates if the user is an admin if so then it returns the view
     * If the user is not logged in or the user is not an admin redirect with an error
     * @takes view 
     * @returns view/redirect
     * */
    public function validateAdmin($view){
        if(!Auth::user()){
            return redirect("/")->with("error","No user logged in.");
        }
       else if(!Auth::user()->is_admin){
            return redirect()->route("home")->with("error","User not authorized to enter this section.");
        }
        return $view;
    }

    public function validateAdminOrOperator($view){
        if(!Auth::user()){
            return redirect("/")->with("error","No user logged in.");
        }
        else if(!Auth::user()->is_admin && !Auth::user()->is_operator){
            return redirect()->route("home")->with("error","User not authorized to enter this section.");
        }
        return $view;
    }

    public function blockRegularUsers(){
        if(!Auth::user()){
            return false;
        }
        if(!Auth::user()->is_admin && !Auth::user()->is_operator){
            return false;
        }
        return true;
    }
}
