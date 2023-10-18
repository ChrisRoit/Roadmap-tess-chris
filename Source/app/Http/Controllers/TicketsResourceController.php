<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use App\Models\WorkProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class TicketsResourceController extends TicketsController
{
    
    public function index()
    {
        $ticket = Ticket::orderBy("id","DESC")->paginate(10);
        if(Auth::user()){
            return view ('tickets.index')->with('ticket', $ticket);
        }
        return redirect()->route("login")->with("error","No user logged in.");
    }

    public function create()
    {
        $ticket = Ticket::OrderBy("id","DESC")->get();
        $workprocesses = WorkProcess::orderBy("id","DESC")->get();
        return $this->validateAdminOrOperator(view('tickets.create')->with("ticket",$ticket)->with("workprocesses",$workprocesses));
    }

    public function store(Request $request)
    {
        if($this->validateInputsTickets($request)){
            $ticket = new Ticket();
            $ticket->opdracht = $request->opdracht;
            $ticket->lesweek = $request->lesweek;
            $ticket->sbu_minuten = $request->sbu_minuten;
            $ticket->bot_minuten = $request->bot_minuten;
            $ticket->vaardigheid = $request->vaardigheid;
            $ticket->kennis = $request->kennis;
            $ticket->theorie = $request->theorie;
            $ticket->labs = $request->labs;
            $ticket->thema = $request->thema;
            $ticket->save();

            if(isset($request->workprocesses)){
                $ticket->workprocesses()->attach($request->workprocesses);
            }
            return $this->validateAdminOrOperator(redirect('tickets')->with('success', 'ticket Addedd!'));
        }
        return redirect()->route("ticket_create")->with("error","De gegeven naam is te kort of u heeft het formulier verkeerdingevoerd"); 
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);
        if(Auth::user()){
            return view ('tickets.show')->with('ticket', $ticket);
        }
        return redirect()->route("login")->with("error","No user logged in.");
    }

    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $workprocesses = WorkProcess::orderBy("id","DESC")->get();
        $boundWorkProcesses = $this->grabBoundWorkprocesses($ticket);
        return $this->validateAdminOrOperator(view('tickets.edit')->with('ticket', $ticket)->with("workprocesses",$workprocesses)->with("boundworkprocesses",$boundWorkProcesses));
    }

    public function update(Request $request)
    {
        $ticket = Ticket::find($request->id);

        if($this->validateInputsTickets($request)){
            $ticket->opdracht = $request->opdracht;
            $ticket->lesweek = $request->lesweek;
            $ticket->sbu_minuten = $request->sbu_minuten;
            $ticket->bot_minuten = $request->bot_minuten;
            $ticket->vaardigheid = $request->vaardigheid;
            $ticket->kennis = $request->kennis;
            $ticket->theorie = $request->theorie;
            $ticket->labs = $request->labs;
            $ticket->thema = $request->thema;
            $ticket->save();
            
            if(isset($ticket->workprocesses)){
                $ticket->workprocesses()->sync($request->workprocesses);
            }

            return $this->validateAdminOrOperator(redirect('tickets')->with('success', 'ticket Updated!')); 
        }
        return redirect()->route("ticket_edit",[$ticket->id])->with("error","De gegeven naam is te kort.");
    }

    public function destroy($id)
    {
        $ticket = Ticket::where("id","=","$id")->first();
        if(!isset($ticket)){
            $this->validateAdminOrOperator(redirect('tickets')->with('error', 'No such ticket exists!'));
        }
        $ticket->workprocesses()->sync([]);
        $ticket->delete();
        return $this->validateAdminOrOperator(redirect('tickets')->with('success', 'ticket deleted!')); 
    }

    public function overview(){
        return $this->validateAdminOrOperator(view("tickets.overview")->with("user",Auth::user()));
    }

    public function grabBoundWorkprocesses($ticket){
        $boundIds = [];
        foreach($ticket->workprocesses as $workprocess){
            array_push($boundIds,$workprocess->id);
        }
        return $boundIds;
    }
}
