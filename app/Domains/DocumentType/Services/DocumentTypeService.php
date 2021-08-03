<?php

namespace App\Domains\DocumentType\Services;

use App\Domains\DocumentType\Events\DocumentTypeCreated;
use App\Domains\DocumentType\Events\DocumentTypeUpdated;
use App\Domains\DocumentType\Events\DocumentTypeDeleted;
use App\Domains\DocumentType\Models\DocumentType;
use App\Domains\Document\Models\Document;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService.
 */
class DocumentTypeService extends BaseService
{
    /**
     * DocumentTypeService constructor.
     *
     * @param  DocumentType  $documentType
     */
    public function __construct(DocumentType $documentType)
    {
        $this->model = $documentType;    
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
    public function store(array $data = []): DocumentType
    {
        DB::beginTransaction();

        try {
            $documentType = $this->createDocumentType([                
                'type' => $data['type'],                       
            ]);
        } 
        catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this Document Type. Please try again.'));
        }

        event(new DocumentTypeCreated($documentType));

        DB::commit();

        return $documentType;
    }

    protected function createDocumentType(array $data = []): DocumentType
    {
        // print_r($data);
        return $this->model::create([
            'type' => $data['type'] ?? null,
        ]);     
    }
    
//  for update
    public function update( DocumentType $documentType, array $data = []): DocumentType
    {
        DB::beginTransaction();
        try {
            $documentType->update([               
                'type' => $data['type'],                              
            ]);
        } 
        catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this document type. Please try again.'));
        }

        event(new DocumentTypeUpdated($documentType));

        DB::commit();
        return $documentType;
    }

    public function delete(DocumentType $documentType): DocumentType
    {
        if ($this->deleteById($documentType->id)) {
            event(new DocumentTypeDeleted($documentType));

            return $documentType;
        }
        throw new GeneralException('There was a problem deleting this Document Type. Please try again.');
    }
}
