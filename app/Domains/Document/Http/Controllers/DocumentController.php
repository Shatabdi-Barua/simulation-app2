<?php

namespace App\Domains\Document\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Domains\Document\Http\Requests\StoreDocumentRequest;
use App\Domains\Document\Http\Requests\ShowDocumentRequest;
use App\Domains\Document\Http\Requests\EditDocumentRequest;
use App\Domains\Document\Http\Requests\UpdateDocumentRequest;
use App\Domains\Document\Http\Requests\DeleteDocumentRequest;
use App\Domains\DocumentType\Services\DocumentTypeService;
use App\Domains\Document\Services\DocumentService;
use App\Domains\DocumentType\Models\DocumentType;
use App\Domains\Document\Models\Document;
use App\Domains\Department\Models\Department;
use App\Domains\Unit\Models\Unit;
use Illuminate\Validation;

class DocumentController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(DocumentService $documentService, DocumentTypeService $documentTypeService)
    {
        $this->documentService = $documentService;
        $this->documentTypeService = $documentTypeService;
    }

    public function index()
    {
        return view('backend.document.index');
    }

    /**
     * Show the for m for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documentTypes = DocumentType::all();
        $departments = Department::all();
        $units = Unit::all();
        return view('backend.document.create', compact('documentTypes', 'departments', 'units'));
                // ->withDocumentTypes($this->documentTypeService->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentRequest $request)
    {       
        // if ($request->file('file'))
        // {
        //     $fileName = $request->file->getClientOriginalName();
        //     // return $fileName;
        //     $filePath = $request->file->storeAs('public/documents',$fileName);
        //     // return $filePath;
        //     // $request['file'] = [];           
        // }
        // else{
        //     return 'No file';
        // }
        // $request->fileN = $fileName;
        // return $request['fileN'];
        // return $request;
        $document = $this->documentService->store($request->validated());
        // return redirect()->route('admin.document.index')->withFlashSuccess(__('The document was successfully created.'));
    }

    public function store2(Request $request)
    {     
        // return $request;   
        $request->validate([
            'document_number' => ['required', 'unique:documents'],
            'title' => ['required'],
            'type' => ['required', 'max:255'],
            'description' => ['required'],
            'file'=> ['required'], 
        ]);
       
        $docs = Document::all();
        // print_r($docs);
      
        //     foreach($docs as $doc)
        //     {
        //         if ($doc->document_number == $request->document_number)
        //         {
        //             $exist = 'yes';
        //         }
        //         else{
        //             $exist = 'no';
        //         }
        //     }       
        // return $exist;
        // if ($exist=='yes')
        // {
        //     return redirect()->route('admin.document.create')->withFlashDanger(__('The document number is already taken'));
        // }
        // else{
            if ($request->file('file'))
            {
                $fileName = $request->file->getClientOriginalName();
                // return $fileName;
                $filePath = $request->file->storeAs('public/documents',$fileName);
                // return $filePath;
            }
            else{
                return 'No file';
            }
            $documentType = DocumentType::find($request->type);
            $document = new Document;
            $document->document_number = $request->document_number;
            $document->title = $request->title;        
            $document->description = $request->description;
            $document->link = $fileName; 
            $document->type_id = $request->type;
            // $documentType->documents()->save($document);
            $document->save();

            return redirect()->route('admin.document.index')->withFlashSuccess(__('The document was successfully created.'));
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        // return $document;
        $document = Document::where('id', $document->id)->first();
        $documentType = DocumentType::where('id', $document->type_id)->first();
        return view('backend.document.show', compact('document', 'documentType'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EditDocumentRequest $request, Document $document)
    {
        $document = Document::where('id', $document->id)->first();
        $documentTypes = DocumentType::all();
        return view('backend.document.edit', compact('document', 'documentTypes'));
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
        // return $request;
        $docFile = Document::find($id);
        // return $docFile->link;
        // Storage::delete(public_path('documents',$docFile->link));
       
        // return $docFile;
        $request->validate([
            'document_number' => ['required'],
            'title' => ['required'],
            'type' => ['required', 'max:255'],
            'description' => ['required'],
            'file'=> ['required'], 
        ]);   
        $docs = Document::where('document_number', 'not like', $docFile->document_number)->get(); 
        foreach($docs as $doc)
        {
            if ($doc->document_number == $request->document_number)
            {
                $exist = 'yes';
            }
            else{
                $exist = 'no';
            }
        }
        // return $exist;
        if ($exist=='yes')
        {
            return redirect()->route('admin.document.index')->withFlashDanger(__('The document number is already taken'));
        }
        else{
           if ($request->file('file'))
            {
                $fileName = $request->file->getClientOriginalName();
                $filePath = $request->file->storeAs('public/documents',$fileName);
            }
            else{
                return 'No file';
            }
            $document = Document::find($id);
            Storage::delete('public/documents/'.$document->link);
            $document->document_number = $request->document_number;
            $document->title = $request->title;        
            $document->description = $request->description;
            $document->link = $fileName; 
            $document->type_id = $request->type;
            $document->save();

            return redirect()->route('admin.document.index')->withFlashSuccess(__('The document was successfully updated.'));
        }
        // if ($request->file('file'))
        // {
        //     $fileName = $request->file->getClientOriginalName();
        //     $filePath = $request->file->storeAs('public/documents',$fileName);
        // }
        // else{
        //     return 'No file';
        // }
        // $document = Document::find($id);
        // Storage::delete('public/documents/'.$document->link);
        // $document->document_number = $request->document_number;
        // $document->title = $request->title;        
        // $document->description = $request->description;
        // $document->link = $fileName; 
        // $document->type_id = $request->type;
        // $document->save();

        // return redirect()->route('admin.document.index')->withFlashSuccess(__('The document was successfully updated.'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Document::where('id', $id)->delete();
       return redirect()->route('admin.document.index')->withFlashSuccess(__('The document was successfully deleted.'));
    }

    public function download(Request $request, $file)
    {
        // return Storage::download($file);
        return response()->download(public_path("storage/documents/".$file));
    }
}
