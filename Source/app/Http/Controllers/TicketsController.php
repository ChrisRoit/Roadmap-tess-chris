<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketsController extends UsersController
{
    /*
    $this->validateOpdracht($request->opdracht) &&
    $this->validateLesweek($request->lesweek) &&
    $this->validateSBU_minuten($request->sbu_minuten) &&
    $this->validateBOT_minuten($request->bot_minuten) &&
    $this->validateNivo($request->nivo) &&
    $this->validateVaardigheid($request->vaardigheid) &&
    $this->validateKennis($request->kennis) &&
    $this->validateTheorie($request->theorie) &&
    $this->validateLabs($request->labs) &&
    $this->validateThema($request->thema) 


    */

    public function validateInputsTickets(Request $request){
        if(
            $this->validateOpdracht($request->opdracht) &&
            $this->validateLesweek($request->lesweek) &&
            $this->validateSBU_minuten($request->sbu_minuten) &&
            $this->validateBOT_minuten($request->bot_minuten) &&
            $this->validateVaardigheid($request->vaardigheid) &&
            $this->validateKennis($request->kennis) &&
            $this->validateTheorie($request->theorie) &&
            $this->validateLabs($request->labs) &&
            $this->validateThema($request->thema) 
        ){
            return true;
        }
        return false;
    }

    public function validateOpdracht($opdracht){
        if(strlen($opdracht) > 2){
            return true;
        }
        return false;
    }

    public function validateLesweek($lesweek){
        if(filter_var($lesweek, FILTER_VALIDATE_INT)){
            return true;
        }
        return false;
    }
    
    public function validateSBU_minuten($sbu_minuten){
        if(filter_var($sbu_minuten, FILTER_VALIDATE_INT)){
            return true;
        }
        return false;
    }
    
    public function validateBOT_minuten($bot_minuten){
        if(filter_var($bot_minuten, FILTER_VALIDATE_INT)){
            return true;
        }
        return false;
    }
    
    public function validateVaardigheid($vaardigheid){
        if(strlen($vaardigheid) > 2){
            return true;
        }
        return false;
    }

    public function validateKennis($kennis){
        if(strlen($kennis) > 2){
            return true;
        }
        return false;
    }  
    
    public function validateTheorie($theorie){
        if(strlen($theorie) > 2){
            return true;
        }
        return false;
    }
          
    public function validateLabs($labs){
        if(strlen($labs) > 2){
            return true;
        }
        return false;
    }
    
    public function validateThema($thema){
        if(strlen($thema) > 2){
            return true;
        }
        return false;
    }   
}
