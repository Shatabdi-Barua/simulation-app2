<?php

namespace App\Domains\Unit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domains\Qualification\Models;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit_code', 
        'title', 
        'release_date', 
        'status', 
        'version',        
    ];
    public function qualifications()
    {
        return $this->belongsToMany('App\Domains\Qualification\Models\Qualification','qualification_units')->withTimestamps();
    }
}
