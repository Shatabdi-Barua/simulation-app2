<?php

namespace App\Domains\Document\Events;

use App\Domains\Document\Models\Document;
use Illuminate\Queue\SerializesModels;

/**
 * Class qualificationCreated.
 */
class DocumentCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $document;

    /**
     * @param $qualification
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
    }
}
