<?php

namespace App\Http\Controllers;

use App\Models\Opleiding;

use Illuminate\Http\Request;

class OpleidingsResourceController extends OpleidingsController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $degrees = Opleiding::orderBy("id","DESC")->paginate(10);
        return $this->validateAdminOrOperator(view("opleidingen.index")->with("degrees",$degrees));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return $this->validateAdminOrOperator(view("opleidingen.create"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->validateInputsOpleiding($request)){
            $opleiding = new Opleiding();
            $opleiding->name = $request->name;
            $opleiding->niveau = $request->niveau;
        //
            $opleiding->save();
            return $this->validateAdminOrOperator(redirect('degrees')->with("success","Opleiding created"));
        }
        return redirect()->route("degrees_create")->with("error","De gegeven naam is te kort.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $degrees = Opleiding::find($id);
        return $this->validateAdminOrOperator(view('opleidingen.show')->with("degrees",$degrees));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $opleiding = Opleiding::find($id);
        return $this->validateAdminOrOperator(view('opleidingen.edit')->with('opleiding', $opleiding));
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
        $opleiding = Opleiding::find($request->id);
        if($this->validateInputsOpleiding($request)){
            $opleiding->name = $request->name;
            $opleiding->niveau = $request->niveau;
            $opleiding->save();
            return $this->validateAdminOrOperator(redirect('degrees')->with('success', 'Opleiding Updated!')); 
        }
        
        return redirect()->route("degrees_edit",[$opleiding->id])->with("error","De gegeven naam is te kort.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Opleiding::destroy($id);
        return $this->validateAdminOrOperator(redirect('degrees')->with('success', 'Opleiding deleted!')); 
    }
}
