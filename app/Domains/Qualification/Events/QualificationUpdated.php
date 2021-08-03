<?php

namespace App\Domains\Qualification\Events;

use App\Domains\Qualification\Models\Qualification;
use Illuminate\Queue\SerializesModels;

/**
 * Class QualificationUpdated.
 */
class QualificationUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $qualification;

    /**
     * @param $qualification
     */
    public function __construct(Qualification $qualification)
    {
        $this->qualification = $qualification;
    }
}
