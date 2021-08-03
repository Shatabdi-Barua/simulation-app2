<?php

namespace App\Domains\JobPosition\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description'
    ];
    public function scopeSearch($query, $val)
    {     
        $val = '%'.$val.'%';
        return $query->where('title','like', $val);
    }
}
