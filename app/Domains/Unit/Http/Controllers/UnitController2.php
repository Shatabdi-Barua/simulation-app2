<?php

namespace App\Domains\Unit\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Unit\Models\Unit;
use App\Domains\Qualification\Models\Qualification;
use App\Domains\Qualification\Services\QualificationService;
use App\Domains\Unit\Http\Requests\StoreUnitRequest;
use App\Domains\Unit\Http\Requests\EditUnitRequest;
use App\Domains\Unit\Http\Requests\UpdateUnitRequest;
use App\Domains\Unit\Http\Requests\DeleteUnitRequest;
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
    // public function create()
    // {
    //     $qualifications = Qualification::all();
    //     return view('backend.unit.create', compact('qualifications'));
    // }

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
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title'=>'required|max:255',      
    //         'qualifications' => 'exists:App\Domains\Qualification\Models\Qualification,id'      
    //     ]);

    //     $unit = new Unit;
    //     $unit->title = $request->title;
    //     if (empty($errors))
    //     {
    //         $unit->save();
    //         $unit->qualifications()->sync($request->qualifications);
    //         return redirect( route('admin.unit.index'))->withFlashSuccess(__('Unit is created successfully.'));
    //     }
    //     // $unit->save();
    //     // $unit->qualifications()->sync($request->qualifications)->withFlashError(__('Invalid Qualification ID'));
    //     // // return $unit;

    //     // return redirect( route('admin.unit.index'))->withFlashError(__('Invalid Qualification ID'));
    // }

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
    // public function show($id)
    // {
    //     $unit = Unit::with('qualifications')->where('id', $id)->first();
    //     // $qualification_units = QualificationUnit::all();
    //     return view('backend.unit.show', compact('unit'));
    // }

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
    // public function edit($id)
    // {
    //     $unit = Unit::with('qualifications')->where('id', $id)->first(); 
    //     // return $unit;
    //     $qualifications = Qualification::all();       
    //     return view('backend.unit.edit', compact('unit', 'qualifications'));
    // }

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
    // public function update2(Request $request, $id)
    // {
    //     $request->validate([
    //         'title'=>'required|max:255',
    //         'qualifications' => 'exists:App\Domains\Qualification\Models\Qualification,id'      
    //     ]);

    //     $unit = Unit::find($id);
    //     $unit->title = $request->title;
    //     if (empty($errors))
    //     {
    //         $unit->save();
    //         $unit->qualifications()->sync($request->qualifications);
    //         return redirect( route('admin.unit.index'))->withFlashSuccess(__('Unit is updated successfully.'));
    //     }
    // }

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
    // public function destroy($id)
    // {
    //     Unit::where('id',$id)->delete();
    //     return redirect( route('admin.unit.index'))->withFlashSuccess(__('Unit is deleted successfully.'));
    // }
}
