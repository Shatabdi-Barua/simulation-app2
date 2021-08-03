<?php

namespace App\Domains\Document\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use App\Domains\DocumentType\Models\DocumentType;

class Document extends Model
{
    use HasFactory, HasRoles;
    protected $fillable = [    
        'document_number',  
        'title',      
        'description',
        'link',
        'type_id'
    ];
  
    public function documentType()
    {
        return $this->belongsTo('App\Domains\DocumentType\Models\DocumentType');
    }
    public function scopeSearch($query, $val)
    {     
        $val = '%'.$val.'%';
        // $documentType = DocumentType::where('type', $val)->get();
        return $query->where('document_number','like', $val)
                    ->orWhere('title', 'like',  $val);
        // return $this->getType($val);
    }
    // public function getType($value)
    // {
    //     return DocumentType::where('type', $value)->get();
    //     // return $documentType;
    // }
}
