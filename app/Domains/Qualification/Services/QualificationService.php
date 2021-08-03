<?php

namespace App\Domains\Qualification\Services;

use App\Domains\Qualification\Events\QualificationCreated;
use App\Domains\Qualification\Events\QualificationUpdated;
use App\Domains\Qualification\Events\QualificationDeleted;
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
class QualificationService extends BaseService
{
    /**
     * QualificationService constructor.
     *
     * @param  Qualification  $qualification
     */
    public function __construct(Qualification $qualification)
    {
        $this->model = $qualification;
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
     * @return Qualification
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Qualification
    {
        DB::beginTransaction();

        try {
            $qualification = $this->createQualification([
                'qualification_code' => $data['qualification_code'],
                'title' => $data['title'],       
                'release_date' => $data['release_date'],
                'status'=> $data['status'],
                'version'=> $data['version'],        
            ]);
            $qualification->units()->sync($data['units'] ?? [] );
        } 
        catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this qualification. Please try again.'));
        }

        event(new QualificationCreated($qualification));

        DB::commit();

        return $qualification;
    }
    protected function createQualification(array $data = []): Qualification
    {
        return $this->model::create([
            'qualification_code' => $data['qualification_code'] ?? null,
            'title' => $data['title'] ?? null,   
            'release_date' => $data['release_date'] ?? null,
            'status'=> $data['status'] ?? null,
            'version'=> $data['version'] ?? null,            
        ]);
    }
    
    // for update
    public function update(Qualification $qualification, array $data = []): Qualification
    {
        DB::beginTransaction();

        try {
            $qualification->update([
                'qualification_code' => $data['qualification_code'],
                'title' => $data['title'], 
                'release_date' => $data['release_date'],
                'status'=> $data['status'],
                'version'=> $data['version'],                  
            ]);
            $qualification->units()->sync($data['units'] ?? [] );

        } 
        catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this qualification. Please try again.'));
        }

        event(new QualificationUpdated($qualification));

        DB::commit();

        return $qualification;
    }
    public function delete(Qualification $qualification): Qualification
    {
        // return $qualification;
        if (count($qualification->units) > 0) {
            throw new GeneralException(__('You can not delete this qualification. It has associate unit'));
        }

        if ($this->deleteById($qualification->id)) {
            event(new QualificationDeleted($qualification));

            return $qualification;
        }
        throw new GeneralException('There was a problem deleting this qualification. Please try again.');
    }
}
