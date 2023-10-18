<?php

namespace App\Models;
use App\Models\Ticket;
use App\Models\Kerntaak;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Workprocess extends Model
{
    use HasFactory;

    protected $hidden = [];

    protected $fillable = [
        "werkprocess",
    ];

    public function kerntaak(){
        return $this->belongsTo(Kerntaak::class,"kerntaak_id");
    }

    public function tickets(){
        return $this->belongsToMany(Ticket::class,"ticketsworkprocessesbindings");
    }
}
