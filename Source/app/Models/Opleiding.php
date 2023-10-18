<?php

namespace App\Models;
use App\Models\Kerntaak;
use App\Models\Roadmap;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opleiding extends Model
{
    use HasFactory;

    protected $table = "degrees";

    protected $fillable = [
        "name",
    ];
    
    public function kerntaken(){
        return $this->hasMany(Kerntaak::class,"opleiding_id");
    }

    public function roadmaps(){
        return $this->hasMany(Roadmap::class,"opleiding_id");
    }
}
