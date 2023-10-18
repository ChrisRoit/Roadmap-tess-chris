<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkProcessesController extends UsersController
{
    public function validateInputsWerkprosess(Request $request){
        if($this->validateWerkproses($request->werkprocess)){
            return true;
        }
        return false;
    }
    public function validateWerkproses($werkprocess){
        if(strlen($werkprocess) > 2){
            return true;
        }
        return false;
    }
}
