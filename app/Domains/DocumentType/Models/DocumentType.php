<?php

namespace App\Domains\DocumentType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class DocumentType extends Model
{
    use HasFactory, HasRoles;
    protected $fillable = [      
        'type'        
    ];
    public function documents()
    {
        return $this->hasMany('App\Domains\Document\Models\Document');
    }
    public function scopeSearch($query, $val)
    {     
        $val = '%'.$val.'%';
        return $query->where('type','like', $val);       
    }
}
