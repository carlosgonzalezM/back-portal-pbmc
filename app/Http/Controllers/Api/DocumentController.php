<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Http\Resources\DocumentResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        return DocumentResource::collection(
            Document::query()
            ->orderBy('created_at', 'desc')
            ->paginate(10)
        );
    }
    public function store(StoreDocumentRequest $request)
    {
        $data = $request->validated();
        $documentName = Str::random(32) . '.' . $data['document']->getClientOriginalExtension();
        Storage::disk('public')->put( $documentName , file_get_contents($data['document']));

        $data['document'] = $documentName;
        $document = Document::create($data);

        return response(new DocumentResource($document), 201);
    }
    public function show(Document $document)
    {
        return new DocumentResource($document);
    }
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $data = $request->validated();
        $documentName = $document['document'];

        if ($request->hasFile('document')) {
            $documentName = Str::random(32) . '.' . $request->document->getClientOriginalExtension();
            Storage::disk('public')->put($documentName, file_get_contents($request->document));
            $data['document'] = $documentName;
        }

        $document->update($data);

        return new DocumentResource($document);
    }
    public function destroy(Document $document)
    {
        $document->delete();
        return response("", 204);
    }

    function download(string $archivo){
        $path = storage_path("app/public/$archivo");
        return response()->download($path);
    }
}
