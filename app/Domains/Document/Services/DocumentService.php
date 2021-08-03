<?php

namespace App\Domains\Document\Services;

use App\Domains\Document\Events\DocumentCreated;
use App\Domains\Document\Events\DocumentUpdated;
use App\Domains\Document\Events\DocumentDeleted;
use App\Domains\Document\Models\Document;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService.
 */
class DocumentService extends BaseService
{
    /**
     * DocumentService constructor.
     *
     * @param  Document  $document
     */
    public function __construct(Document $document)
    {
        $this->model = $document;
    }

    /**
     * @param $type
     * @param  bool|int  $perPage
     *
     * @return mixed
     */
    /** 
     * @param  array  $data
     *
     * @return DocumentType
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Document
    {
        // print_r($data['type']);
        if ($data['file'])
            {
                $fileName = $data['file']->getClientOriginalName();
                // return $fileName;
                $filePath = $data['file']->storeAs('public/documents',$fileName);
                // return $filePath;
                // $request['file'] = [];
                $data['fileName'] = $fileName;           
            }
            else{
                return 'No file';
            }
            $document = $this->createDocument([     
                'document_number' => $data['document_number'],           
                'title' => $data['title'],
                 
                'description' => $data['description'],
                'link' => $data['fileName'],  
                'type_id' => $data['type'], 
                
            ]);
            return $document;
        // DB::beginTransaction();       
        // // print_r($data['fileName']);
        // // // $document = $linkName;
        // try {
        //     if ($data['file'])
        //     {
        //         $fileName = $data['file']->getClientOriginalName();
        //         // return $fileName;
        //         $filePath = $data['file']->storeAs('public/documents',$fileName);
        //         // return $filePath;
        //         // $request['file'] = [];
        //         $data['fileName'] = $fileName;           
        //     }
        //     else{
        //         return 'No file';
        //     }
        //     $document = $this->createDocument([     
        //         'document_number' => $data['document_number'],           
        //         'title' => $data['title'],
        //         'type' => $data['type'],
        //         'description' => $data['description'],
        //         'link' => $data['fileName'],                       
        //     ]);
        // } 
        // catch (Exception $e) {
        //     DB::rollBack();

        //     throw new GeneralException(__('There was a problem creating this Document. Please try again.'));
        // }
        // event(new DocumentCreated($document));

        // DB::commit();
        // // return $linkName;
        // return $document;
    }
    protected function createDocument(array $data = []): Document
    {
        // print_r($data['link']);
        return $this->model::create([
            'document_number' => $data['document_number'] ?? null,   
            'title' => $data['title'] ?? null,        
            'type' => $data['type'] ?? null, 
            'description' => $data['description'] ?? null,
            'link' => $data['fileName'] ?? null,                       
        ]);
    }
    
// //     // for update
//     public function update( DocumentType $documentType, array $data = []): DocumentType
//     {
//         DB::beginTransaction();

//         try {
//             $documentType->update([               
//                 'type' => $data['type'],                              
//             ]);

//         } 
//         catch (Exception $e) {
//             DB::rollBack();

//             throw new GeneralException(__('There was a problem updating this document type. Please try again.'));
//         }

//         event(new DocumentTypeUpdated($documentType));

//         DB::commit();
//         return $documentType;
//     }
//     public function delete(DocumentType $documentType): DocumentType
//     {
//         if ($this->deleteById($documentType->id)) {
//             event(new DocumentTypeDeleted($documentType));

//             return $documentType;
//         }
//         throw new GeneralException('There was a problem deleting this Document Type. Please try again.');
//     }
}
