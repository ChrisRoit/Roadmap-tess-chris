<?php

namespace App\Http\Controllers;
use App\Http\Controllers\RoadmapsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Roadmap;
use App\Models\User;
use App\Models\Opleiding;

class RoadmapsResourceController extends RoadmapsController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->blockRegularUsers()){
            return redirect()->route("home")->with("error","User not authorized to enter this section.");
        };
        $roadmaps = Roadmap::orderBy("id","DESC")->paginate(10);
        //
        return view("roadmap.index")->with("roadmaps",$roadmaps);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->blockRegularUsers()){
            return redirect()->route("home")->with("error","User not authorized to enter this section.");
        };
        $users = User::orderby("id","DESC")->get();
        $degrees = Opleiding::orderBy("id","DESC")->get();
        //
        return view("roadmap.create")->with("users",$users)->with("degrees",$degrees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->blockRegularUsers()){
            return redirect()->route("home")->with("error","User not authorized to enter this section.");
        };
        if(!$this->isInputSet($request->user) || !$this->isInputSet($request->degree) || !$this->isInteger($request->user) || !$this->isInteger($request->degree)){
            return redirect()->route("roadmaps")->with("error","Invalid value.");
        }
        //
        $roadmap = new Roadmap();
        $roadmap->user_id = $request->user;
        $roadmap->opleiding_id = $request->degree;
        $roadmap->save();
        return redirect()->route("roadmaps")->with("success","Roadmap Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$this->isInteger($id)){
            return redirect()->route("roadmaps")->with("error","id is not an integer.");
        }
        $roadmap = Roadmap::where("id","=","$id")->first();
        if(!isset($roadmap)){
            return redirect()->route("roadmaps")->with("error","No such roadmap exists.");
        }
        if(!$this->roadmapBelongsToUser($roadmap)){
            return redirect()->route("roadmaps")->with("error","You are unauthorized to access this roadmap.");
        }
        $weekNumber = $this->getCurrentWeekNumber();
        //
        return view("roadmap.show")->with("roadmap",$roadmap)->with("weeknumber",$weekNumber);
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
        if(!$this->blockRegularUsers()){
            return redirect()->route("home")->with("error","User not authorized to enter this section.");
        };
        if(!$this->isInteger($id)){
            return redirect()->route("roadmaps")->with("error","id is not an integer.");
        }
        $roadmap = Roadmap::where("id","=","$id")->first();
        $users = User::orderBy("id","DESC")->get();
        $degrees = Opleiding::orderBy("id","DESC")->get();
        if(!isset($roadmap)){
            return redirect()->route("roadmaps")->with("error","No such roadmap exists.");
        };
        return view("roadmap.edit")->with("roadmap",$roadmap)->with("degrees",$degrees)->with("users",$users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        if(!$this->blockRegularUsers()){
            return redirect()->route("home")->with("error","User not authorized to enter this section.");
        };
        if(!$this->isInteger($request->user)){
            return redirect()->route("roadmaps")->with("error","id is not an integer.");
        }
        $roadmap = Roadmap::where("id","=","$request->roadmap")->first();
        if(!isset($roadmap)){
            return redirect()->route("roadmaps_edit",["id" => "$request->roadmap"])->with("error","No such roadmap exists.");
        }
        if(!$this->isInputSet($request->user) || !$this->isInputSet($request->degree) || !$this->isInteger($request->user) || !$this->isInteger($request->degree)){
            return redirect()->route("roadmaps")->with("error","Invalid value.");
        }
        $roadmap->user_id = $request->user;
        $roadmap->opleiding_id = $request->degree;
        $roadmap->save();
        return redirect()->route("roadmaps")->with("success","Roadmap updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->blockRegularUsers()){
            return redirect()->route("home")->with("error","User not authorized to enter this section.");
        };
        if(!$this->isInteger($request->user)){
            return redirect()->route("roadmaps")->with("error","id is not an integer.");
        }
        $roadmap = Roadmap::where("id","=","$id")->first();
        if(isset($roadmap)){
            $roadmap->delete();
            return redirect()->route("roadmaps")->with("success","Roadmap deleted.");
        }
        return redirect()->route("roadmaps")->with("warning","No such roadmap exists.");
    }
}
