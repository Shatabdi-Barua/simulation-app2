<?php

namespace App\Domains\Qualification\Events;

use App\Domains\Qualification\Models\Qualification;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserDeleted.
 */
class QualificationDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $qualification;

    /**
     * @param $user
     */
    public function __construct(Qualification $qualification)
    {
        $this->qualification = $qualification;
    }
}
