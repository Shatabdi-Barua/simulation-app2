<?php

namespace App\Domains\DocumentType\Events;

use App\Domains\DocumentType\Models\DocumentType;
use Illuminate\Queue\SerializesModels;

/**
 * Class qualificationCreated.
 */
class DocumentTypeCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $documentType;

    /**
     * @param $qualification
     */
    public function __construct(DocumentType $documentType)
    {
        $this->documentType = $documentType;
    }
}
