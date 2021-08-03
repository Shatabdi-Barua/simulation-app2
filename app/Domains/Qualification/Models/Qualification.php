<?php

namespace App\Domains\Qualification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Qualification extends Model
{
    use HasFactory, HasRoles;
    protected $fillable = [
        'qualification_code',
        'title',        
        'release_date',
        'status',
        'version',
    ];
    // public $sortable = ['qualification_code', 'title'];
    public function units()
    {
        return $this->belongsToMany('App\Domains\Unit\Models\Unit','qualification_units')->withTimestamps();
    }
  
}
