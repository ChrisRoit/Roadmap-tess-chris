<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RoadmapsController extends UsersController
{

    public function getCurrentWeekNumber(){
        return Carbon::now()->setTimezone("Europe/Amsterdam")->weekOfYear;
    }

    //

    public function isInputSet($id){
        if(isset($id)){
            return true;
        }
        return false;
    }

    public function isInteger($id){
        if(filter_var($id,FILTER_VALIDATE_INT)){
            return true;
        }
        return false;
    }

    public function roadmapBelongsToUser($roadmap){
        if(!Auth::user()->is_admin && !Auth::user()->is_operator){
            if($roadmap->user->id != Auth::user()->id){
                return false;
            }
        }
        return true;
    }
}
