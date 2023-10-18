<?php

namespace App\Http\Controllers;

use App\Models\Kerntaak;
use App\Models\Opleiding;
use Illuminate\Http\Request;
 
class KerntaakResourceController extends KerntaakController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kerntaak = Kerntaak::orderBy("id","DESC")->paginate(10);
        return $this->validateAdminOrOperator(view ('kerntaak.index')->with('kerntaak', $kerntaak));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $degrees = Opleiding::orderBy("id","DESC")->get();
        return $this->validateAdminOrOperator(view('kerntaak.create')->with("degrees",$degrees));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->validateInputsKerntaak($request)){
            /*$input = $request->all();
            Kerntaak::create($input);*/

            $kerntaak = new Kerntaak();
            $kerntaak->code = $request->code;
            $kerntaak->kerntaak = $request->kerntaak;
            $kerntaak->opleiding_id = $request->degrees;

            $kerntaak->save();

            return $this->validateAdminOrOperator(redirect()->route("kerntaken")->with('flash_message', 'Kerntaak Addedd!')); 
        }
        return redirect()->route("kerntaken_create")->with("error","De gegeven naam is te kort.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kerntaak = Kerntaak::find($id);
        return $this->validateAdminOrOperator(view('kerntaak.show')->with('kerntaak', $kerntaak));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kerntaak = Kerntaak::find($id);
        $degrees = Opleiding::orderBy("id","DESC")->get();
        return $this->validateAdminOrOperator(view('kerntaak.edit')->with('kerntaak', $kerntaak)->with("degrees",$degrees));
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
        $kerntaak = Kerntaak::find($request->id);

        if($this->validateInputsKerntaak($request)){
            $kerntaak->code = $request->code;
            $kerntaak->kerntaak = $request->kerntaak;
            $kerntaak->opleiding_id = $request->degrees;
            
            $kerntaak->save();
            
            return $this->validateAdminOrOperator(redirect()->route("kerntaken")->with('success', 'Kerntaak Updated!')); 
        }
        return redirect()->route("kerntaken_edit",[$kerntaak->id])->with("error","De gegeven naam is te kort.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kerntaak::destroy($id);
        return $this->validateAdminOrOperator(redirect()->route("kerntaken")->with('success', 'kerntaak deleted!'));  
    }
}
