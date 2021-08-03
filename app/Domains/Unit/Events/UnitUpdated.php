<?php

namespace App\Domains\Unit\Events;

use App\Domains\Unit\Models\Unit;
use Illuminate\Queue\SerializesModels;

/**
 * Class QualificationUpdated.
 */
class UnitUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $unit;

    /**
     * @param $qualification
     */
    public function __construct(Unit $unit)
    {
        $this->unit = $unit;
    }
}
