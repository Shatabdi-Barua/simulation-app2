<?php

namespace App\Domains\Qualification\Events;

use App\Domains\Qualification\Models\QualificationUnit;
use Illuminate\Queue\SerializesModels;

/**
 * Class QualificationUpdated.
 */
class QualificationUnitDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $unit;

    /**
     * @param $qualification
     */
    public function __construct(QualificationUnit $unit)
    {
        $this->unit = $unit;
    }
}
