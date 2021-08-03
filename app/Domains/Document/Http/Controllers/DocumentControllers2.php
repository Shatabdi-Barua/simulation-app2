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
        return view('backend.document.create', compact('documentTypes'));
                // ->withDocumentTypes($this->documentTypeService->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        // return $request;   
        $request->validate([
            'title' => ['required'],
            'type' => ['required', 'max:255'],
            'description' => ['required'],
            'file'=> ['required'], 
        ]);
        // return $request->file("file");
        // $name = $file->getClientOriginalName();
        // return $request->file('file')->storeAs('public', $name);
       
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
        $document->title = $request->title;        
        $document->description = $request->description;
        $document->link = $fileName; 
        $document->type_id = $request->type;
        // $documentType->documents()->save($document);
        $document->save();

        return redirect()->route('admin.document.index')->withFlashSuccess(__('The document was successfully created.'));
    }
    public function store3(StoreDocumentRequest $request)
    {
        // return $request;
        // $name = $request->file('link');
        // return $name;
        // if ($request->hasFile('file'))
        // {
            // return '00';
            // $linkName = $data['link']->getClientOriginalName();
            // // return $imageName;
            // $linkPath = $data['link']->storeAs('public',$linkName);
            // // return $imagePath;
        // }
        // else{
        //         return 'No file';
        // }
       $document = $this->documentService->store($request->validated());
    //    return $document;
    //    return redirect()->route('admin.document.index')->withFlashSuccess(__('The document was successfully created.'));
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
        // return view('backend.document.show')
        //         ->withDocument($document);
        return view('backend.document.show', compact('document', 'documentType'));
    }
    public function show2(ShowDocumentRequest $request, Document $document)
    {
        // return $document;
        $document = Document::where('id', $document->id)->first();
        $documentType = DocumentType::where('id', $document->type_id)->first();
        // return view('backend.document.show')
        //         ->withDocument($document);
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
        $request->validate([
            'title' => ['required'],
            'type' => ['required', 'max:255'],
            'description' => ['required'],
            'file'=> ['required'], 
        ]);
       
        if ($request->file('file'))
        {
            $fileName = $request->file->getClientOriginalName();
            $filePath = $request->file->storeAs('public/documents',$fileName);
        }
        else{
            return 'No file';
        }
        $document = Document::find($id);
        $document->title = $request->title;        
        $document->description = $request->description;
        $document->link = $fileName; 
        $document->type_id = $request->type;
        $document->save();

        return redirect()->route('admin.document.index')->withFlashSuccess(__('The document was successfully updated.'));
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

    public function viewPdf(Request $request)
    {
        // $file = Document::where('id', $request)->get();
        return $request;
    }
}
