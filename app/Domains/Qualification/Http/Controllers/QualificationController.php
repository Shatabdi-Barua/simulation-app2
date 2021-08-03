<?php

namespace App\Domains\Qualification\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Qualification\Models\Qualification;
use App\Domains\Qualification\Models\QualificationUnit;
use App\Domains\Unit\Models\Unit;
use App\Domains\Qualification\Http\Requests\StoreQualificationRequest;
use App\Domains\Qualification\Http\Requests\EditQualificationRequest;
use App\Domains\Qualification\Http\Requests\UpdateQualificationRequest;
use App\Domains\Qualification\Http\Requests\DeleteQualificationRequest;
use App\Domains\Qualification\Services\QualificationService;
use App\Domains\Unit\Services\UnitService;
use Illuminate\Validation;

use Illuminate\Support\Facades\DB;

class QualificationController
{
    protected $qualificationService;
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
        return view('backend.qualification.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $units = Unit::all();
        return view('backend.qualification.create')
            ->withUnits($this->unitService->get());           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQualificationRequest $request)
    {
        $qualification = $this->qualificationService->store($request->validated());

        return redirect()->route('admin.qualification.index')->withFlashSuccess(__('The qualification was successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Qualification $qualification)
    {
        // return $qualification;
        // return view('backend.qualification.show')        
        //         ->withQualification($qualification);
        // $qualification = Qualification::with('units')->where('id', $qualification->id)->first();
        // $qualUnit = QualificationUnit::where('qualification_id', $qualification->id)->get();
        // return view('backend.qualification.show', compact('qualification', 'qualUnit'));    
        $qualification = Qualification::where('id', $qualification->id)->first();
        // $qualificationUnits = DB::table('qualifications')
        //     ->join('qualification_units', 'qualifications.id', '=', 'qualification_units.qualification_id')
        //     ->join('units', 'qualification_units.unit_id', '=', 'units.id')
        //     ->where('qualifications.id', $qualification->id)
        //     ->select('units.*', 'qualification_units.id as quID')
        //     ->get();
        $qualificationUnits = Qualification::where('qualifications.id', $qualification->id)
        ->leftJoin('qualification_units', 'qualifications.id', '=', 'qualification_units.qualification_id')
        ->Join('units', 'qualification_units.unit_id', '=', 'units.id')
        ->select('units.*','qualification_units.id as quID')->get();

        // return $qualification;
        return view('backend.qualification.show', compact('qualification', 'qualificationUnits'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit(EditQualificationRequest $request, Qualification $qualification)
    {
        return view('backend.qualification.edit')
            ->withQualification($qualification)            
            ->withUnits($this->unitService->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQualificationRequest $request, Qualification $qualification)
    {
        $this->qualificationService->update($qualification, $request->validated());
        return redirect()->route('admin.qualification.index', $qualification)->withFlashSuccess(__('Qualification is updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteQualificationRequest $request, Qualification $qualification)
    {
        $this->qualificationService->delete($qualification);

        return redirect()->route('admin.qualification.index')->withFlashSuccess(__('Qualification is deleted successfully.'));
    }
}
