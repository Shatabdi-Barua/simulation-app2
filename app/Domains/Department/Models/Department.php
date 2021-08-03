<?php

namespace App\Domains\Department\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable=[
        'title'
    ];
    
    public function scopeSearch($query, $val)
    {
        $val = '%'.$val.'%';
        return $query->where('title', 'like', $val);
    } 
}
