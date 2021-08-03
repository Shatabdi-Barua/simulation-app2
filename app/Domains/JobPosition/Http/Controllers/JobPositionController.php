<?php

namespace App\Domains\JobPosition\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\JobPosition\Models\JobPosition;

class JobPositionController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.job_position.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.job_position.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required']
        ]);

        $jobPosition = new JobPosition;
        $jobPosition->title = $request->title;
        $jobPosition->description = $request->description;
        $jobPosition->save();

        return redirect()->route('admin.job.index')->withFlashSuccess(__('Job Position created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = JobPosition::where('id', $id)->first();
        return view('backend.job_position.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = JobPosition::where('id', $id)->first();
        return view('backend.job_position.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required']
        ]);

        $jobPosition = JobPosition::find($id);
        $jobPosition->title = $request->title;
        $jobPosition->description = $request->description;
        $jobPosition->save();

        return redirect()->route('admin.job.index')->withFlashSuccess(__('Job Position updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JobPosition::where('id', $id)->delete();
        return redirect()->route('admin.job.index')->withFlashSuccess(__('Job Position deleted successfully.'));
    }
}
