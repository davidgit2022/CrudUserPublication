<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{

    public $pagination = 5;
    public function index()
    {
        $publications = Publication::latest()->paginate($this->pagination);
        return view('publications.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (request()->ajax()) {
            return datatables()->of(Publication::select('id', 'title', 'content', 'author_id'))
                ->addColumn('action', 'common.button-action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('publications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:publications,title,',
            'content' => 'required'
        ], [
            'title.required' => 'El campo es obligatorio',
            'title.unique' => 'El campo debe ser unico',
            'content.required' => 'El campo es obligatorio'
        ]);


        $user = Auth::user();

        $publication = new Publication();

        $publication->title = $request->title;
        $publication->content = $request->content;
        $publication->author_id = $user->id;

        $publication->save();

        return response()->json($publication);
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication, $id)
    {
        $publication = Publication::find($id);

        return view('publications.show', compact('publication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $publication = Publication::find($id);

        return response()->json($publication);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:publications,title,' . $request->id,
            'content' => 'required'
        ], [
            'title.required' => 'El campo es obligatorio',
            'title.unique' => 'El campo debe ser unico',
            'content.required' => 'El campo es obligatorio'
        ]);
        $user = Auth::user();

        $publication = Publication::find($request->id);

        $publication->update([
            'title' => $request->title,
            'content' => $request->content,
            'author_id' =>  $user->id,
        ]);


        return response()->json($publication);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $publication = Publication::find($id)->delete();

        return response()->json($publication);
    }
}
