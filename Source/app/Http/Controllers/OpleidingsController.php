<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpleidingsController extends UsersController
{
    //
    public function validateInputsOpleiding(Request $request){
        if($this->validateName($request->name)){
            return true;
        }
        return false;
    }

    public function validateName($name){
        if(strlen($name) > 2){
            return true;
        }
        return false;
    }
    
}
