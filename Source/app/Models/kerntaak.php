<?php

namespace App\Models;
use App\Models\Opleiding;
use App\Models\Workprocess;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerntaak extends Model
{
    protected $table = 'kerntaak';
    protected $primaryKey = 'id';
    protected $fillable = ['kerntaak', 'code'];

    public function opleiding(){
        return $this->belongsTo(Opleiding::class,"opleiding_id");
    }

    public function workprocesses(){
        return $this->hasMany(workprocess::class,"kerntaak_id");
    }
}


