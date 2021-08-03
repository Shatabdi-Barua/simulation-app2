<?php

namespace App\Domains\Qualification\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\Qualification\Models\Qualification;
use App\Domains\Qualification\Http\Requests\StoreQualificationRequest;
use App\Domains\Qualification\Http\Requests\EditQualificationRequest;
use App\Domains\Qualification\Http\Requests\UpdateQualificationRequest;
use App\Domains\Qualification\Http\Requests\DeleteQualificationRequest;
use App\Domains\Unit\Models\Unit;
use Illuminate\Validation;
use App\Domains\Qualification\Services\QualificationService;

class QualificationController
{
    protected $qualificationService;
    public function __construct(QualificationService $qualificationService)
    {
        $this->qualificationService = $qualificationService;       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $qualifications = Qualification::all();
        // return view('backend.qualification.index', compact('qualifications'));
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
        return view('backend.qualification.create');
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
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'max:255|required|unique:qualifications',
    //     ]);

    //     $qualification = new Qualification;
    //     $qualification->title = $request->title;
    //     $qualification->save();

    //     return redirect( route('admin.qualification.index') )->withFlashSuccess(__('The qualification was successfully created.'));
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Qualification $qualification)
    {
        return view('backend.qualification.show')
            ->withQualification($qualification);
    }
    // public function show($id)
    // {
    //     $qualification = Qualification::with('units')->where('id', $id)->first();
    //     // return $qualification;
    //     return view('backend.qualification.show', compact('qualification'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EditQualificationRequest $request, Qualification $qualification)
    {
        return view('backend.qualification.edit')
            ->withQualification($qualification);
    }
    // public function edit($id)
    // {
    //     $qualification = Qualification::where('id', $id)->first();        
    //     return view('backend.qualification.edit', compact('qualification'));
    // }

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
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'title' => 'required|max:255',
    //     ]);

    //     $qualification = Qualification::find($id);
    //     $qualification->title = $request->title;
    //     $qualification->save();

    //     return redirect( route('admin.qualification.index'))->withFlashSuccess(__('Qualification is updated successfully.'));
    // }

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
    // public function destroy($id)
    // {
    //     // return $id;
    //     $qualification = Qualification::with('units')->where('id', $id)->first();
        
    //     if (count($qualification->units)>0)
    //     {
    //         return redirect( route('admin.qualification.index'))->withFlashWarning(__('Can not Delete, this qualification has an associated Unit.'));
    //     }
    //     else{
    //         Qualification::where('id', $id)->delete();
    //         return redirect( route('admin.qualification.index'))->withFlashSuccess(__('Qualification is deleted successfully.'));
    //     }          
    //     // Qualification::where('id', $id)->delete();
        
    // }
}
