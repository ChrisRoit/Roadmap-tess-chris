<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KerntaakController extends UsersController
{
    public function validateInputsKerntaak(Request $request){
        if($this->validateKerntaak($request->kerntaak)){
            return true;
        }
        return false;
    }
    public function validateKerntaak($kerntaak){
        if(strlen($kerntaak) > 2){
            return true;
        }
        return false;
    }

}
