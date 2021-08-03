<?php

namespace App\Domains\Unit\Services;

use App\Domains\Unit\Events\UnitCreated;
use App\Domains\Unit\Events\UnitUpdated;
use App\Domains\Unit\Events\UnitDeleted;
use App\Domains\Qualification\Events\QualificationUnitDeleted;
use App\Domains\Unit\Models\Unit;
use App\Domains\Qualification\Models\Qualification;
use App\Domains\Qualification\Models\QualificationUnit;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService.
 */
class UnitService extends BaseService
{
    /**
     * QualificationService constructor.
     *
     * @param  Unit  $unit
     */
    public function __construct(Unit $unit)
    {
        $this->model = $unit;
    }

    /**
     * @param $type
     * @param  bool|int  $perPage
     *
     * @return mixed
     */
    // public function getByType($type, $perPage = false)
    // {
    //     if (is_numeric($perPage)) {
    //         return $this->model::byType($type)->paginate($perPage);
    //     }

    //     return $this->model::byType($type)->get();
    // }
    /**
     * @param  array  $data
     *
     * @return Unit
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Unit
    {
        // print_r($data);
        DB::beginTransaction();
        // return $unit->$this->syncQualifications($data['qualifications'] ?? []);
        try {
            $unit = $this->createUnit([
                'unit_code' => $data['unit_code'],
                'title' => $data['title'],     
                'release_date' => $data['release_date'],
                'status'=> $data['status'],
                'version'=> $data['version'],
            ]);
            $unit->qualifications()->sync($data['qualifications'] ?? [] );
            // $unit->syncQualifications($data['qualifications'] ?? []);

        } 
        catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this unit. Please try again.'));
        }

        event(new UnitCreated($unit));

        DB::commit();


        return $unit;
    }
    protected function createUnit(array $data = []): Unit
    {
        return $this->model::create([
            'unit_code' => $data['unit_code'] ?? null,
            'title' => $data['title'] ?? null,  
            'release_date' => $data['release_date'] ?? null,
            'status'=> $data['status'] ?? null,
            'version'=> $data['version'] ?? null,          
        ]);
    }
    
    // // for update
    public function update(array $data = [], Unit $unit): Unit
    {
        DB::beginTransaction();

        try {
            $unit->update([
                'unit_code' => $data['unit_code'],
                'title' => $data['title'],      
                'release_date' => $data['release_date'],
                'status'=> $data['status'],
                'version'=> $data['version'],         
            ]);

            $unit->qualifications()->sync($data['qualifications'] ?? [] );

        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this unit. Please try again.'));
        }

        event(new UnitUpdated($unit));

        DB::commit();

        return $unit;
    }
    public function delete(Unit $unit): Unit
    {
        // return $qualification;
        if ($this->deleteById($unit->id)) {
            event(new UnitDeleted($unit));

            return $unit;
        }
        throw new GeneralException('There was a problem deleting this qualification. Please try again.');
    }
    // public function deleteQualificationUnit(QualificationUnit $unit): QualificationUnit
    // {
    //     // return $unit;
    //     if ($this->delete($unit-> id)) {
    //         event(new QualificationUnitDeleted($unit));

    //         return $unit;
    //     }
    //     throw new GeneralException('There was a problem deleting this qualification. Please try again.');
    // }
}
