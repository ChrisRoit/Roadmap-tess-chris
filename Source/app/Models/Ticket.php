<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkProcess;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        "opdracht",
        "lesweek",
        "sbu_minuten",
        "bot_minuten",
        "nivo",
        "vaardigheid",
        "kennis",
        "theorie",
        "labs",
        "thema",
    ];

    protected $hidden = [];

    public function workprocesses(){
        return $this->belongsToMany(WorkProcess::class,"ticketsworkprocessesbindings");
    }
}
