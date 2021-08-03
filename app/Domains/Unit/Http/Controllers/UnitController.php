<?php

namespace App\Domains\Unit\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Unit\Models\Unit;
use App\Domains\Qualification\Models\Qualification;
use App\Domains\Qualification\Models\QualificationUnit;
use App\Domains\Qualification\Services\QualificationService;
use App\Domains\Unit\Http\Requests\StoreUnitRequest;
use App\Domains\Unit\Http\Requests\EditUnitRequest;
use App\Domains\Unit\Http\Requests\UpdateUnitRequest;
use App\Domains\Unit\Http\Requests\DeleteUnitRequest;
use App\Domains\Qualification\Http\Requests\DeleteQualificationUnitRequest;
use App\Domains\Unit\Services\UnitService;

class UnitController
{

    protected $qualificationService;
    protected $unitService;

    public function __construct(QualificationService $qualificationService, UnitService $unitService)
    {
        $this->qualificationService = $qualificationService;       
        $this->unitService = $unitService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('backend.unit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $qualifications = Qualification::all();
        return view('backend.unit.create')
            ->withQualification($this->qualificationService->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitRequest $request)
    {
        $unit = $this->unitService->store($request->validated());
        return redirect( route('admin.unit.index'))->withFlashSuccess(__('Unit is created successfully.'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        return view('backend.unit.show')
            ->withUnit($unit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EditUnitRequest $request, Unit $unit)
    {     
        return view('backend.unit.edit')
            ->withUnit($unit)
            ->withQualifications($this->qualificationService->get());
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $this->unitService->update($request->validated(), $unit);
        return redirect( route('admin.unit.index'))->withFlashSuccess(__('Unit is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteUnitRequest $request, Unit $unit)
    {
        $this->unitService->delete($unit);
        return redirect( route('admin.unit.index'))->withFlashSuccess(__('Unit is deleted successfully.'));
    }

    public function delete(DeleteQualificationUnitRequest $request, QualificationUnit $qual)
    {
        // return $qual;
        // echo '1';
        // return $request;
        // print_r($unit);
        // print_r($request);
        // $this->unitService->deleteQualificationUnit($unit);
        QualificationUnit::where('id', $qual->id)->delete();
        return redirect( route('admin.qualification.show', $qual->qualification_id))->withFlashSuccess(__('Unit relationship is deleted successfully.'));
    }
}
