<?php

namespace App\Http\Controllers;
use App\Models\Workprocess;
use App\Models\Ticket;
use App\Models\Kerntaak;
use Illuminate\Http\Request;
 
class WorkProcessesResourceController extends WorkProcessesController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workprocesses = Workprocess::orderBy("id","DESC")->paginate(10);
        
        return $this->validateAdminOrOperator(view ('workprocesses.index')->with('workprocesses', $workprocesses));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kerntaken = Kerntaak::OrderBy("id","DESC")->get();
        $tickets = Ticket::orderBy("id","DESC")->get();
        return $this->validateAdminOrOperator(view('workprocesses.create')->with("kerntaken",$kerntaken)->with("tickets",$tickets));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->validateInputsWerkprosess($request)){
            $workprocess = new WorkProcess();
            $workprocess->werkprocess = $request->werkprocess;
            $workprocess->kerntaak_id = $request->kerntaak;
            
            $workprocess->save();

            if(isset($request->tickets)){
                $workprocess->tickets()->attach($request->tickets);
            }
        
            return $this->validateAdminOrOperator(redirect('workprocesses')->with('success', 'werkprocess Addedd!'));
        }
        return redirect()->route("workprocesses_create")->with("error","De gegeven naam is te kort.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workprocess = Workprocess::find($id);
        return $this->validateAdminOrOperator(view('workprocesses.show')->with('workprocess', $workprocess));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workprocesses = Workprocess::find($id);
        $kerntaken = Kerntaak::OrderBy("id","DESC")->get();
        $tickets = Ticket::orderBy("id","DESC")->get();
        $boundTickets = $this->grabBoundTickets($workprocesses);
        return $this->validateAdminOrOperator(view('workprocesses.edit')->with('workprocesses', $workprocesses)->with("kerntaken",$kerntaken)->with("boundtickets",$boundTickets)->with("tickets",$tickets));
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
        $workprocess = Workprocess::find($request->id);

        if($this->validateInputsWerkprosess($request)){
            $workprocess->werkprocess = $request->werkprocess;
            $workprocess->kerntaak_id = $request->kerntaak;
            
            $workprocess->save();

            if(isset($request->tickets)){
                $workprocess->tickets()->sync($request->tickets);
            }

            return $this->validateAdminOrOperator(redirect('workprocesses')->with('success', 'werkprocess Updated!'));  
        }
        
        return redirect()->route("workprocesses_edit",[$workprocess->id])->with("error","De gegeven naam is te kort.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Workprocess::destroy($id);
        $workprocess = Workprocess::where("id","=","$id")->first();
        if(!isset($workprocess)){
            $this->validateAdminOrOperator(redirect('workprocesses')->with('success', 'werkprocess deleted!')); 
        }

        $workprocess->tickets()->sync([]);

        $workprocess->delete();
        return $this->validateAdminOrOperator(redirect('workprocesses')->with('success', 'werkprocess deleted!')); 
    }

    public function grabBoundTickets($workprocess){
        $boundIds = [];
        foreach($workprocess->tickets as $ticket){
            array_push($boundIds,$ticket->id);
        }
        return $boundIds;
    }
}
