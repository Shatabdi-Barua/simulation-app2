<?php

namespace App\Domains\DocumentType\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\DocumentType\Http\Requests\StoreDocumentTypeRequest;
use App\Domains\DocumentType\Http\Requests\EditDocumentTypeRequest;
use App\Domains\DocumentType\Http\Requests\UpdateDocumentTypeRequest;
use App\Domains\DocumentType\Http\Requests\DeleteDocumentTypeRequest;
use App\Domains\DocumentType\Services\DocumentTypeService;
use App\Domains\DocumentType\Models\DocumentType;

class DocumentTypeController
{
    protected $documentTypeService;
    public function __construct(DocumentTypeService $documentTypeService)
    {
        $this->documentTypeService = $documentTypeService;       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.document_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.document_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreDocumentTypeRequest $request)
    {
        $documentType = $this->documentTypeService->store($request->validated());
        return redirect()->route('admin.document_type.index')->withFlashSuccess(__('The document type was successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EditDocumentTypeRequest $request, DocumentType $documentType)
    {
        return view('backend.document_type.edit')
                ->withDocumentType($documentType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentTypeRequest $request, DocumentType $documentType)
    {
        // return $documentType;
        $this->documentTypeService->update($documentType, $request->validated());
        return redirect()->route('admin.document_type.index')->withFlashSuccess(__('The document type was successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteDocumentTypeRequest $request, DocumentType $documentType)
    {
        $this->documentTypeService->delete($documentType);
        return redirect()->route('admin.document_type.index')->withFlashSuccess(__('The document type was successfully deleted.'));
    }
}
