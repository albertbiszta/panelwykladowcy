<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Material;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{


    /**
     * List of materials for students and uploading modal
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $subjects = $user->subjects()->get();
        $formSubjects = Subject::authSubjects();

        return view('materials.index')->with(compact('subjects', 'formSubjects'));
    }


    /**
     * Store material
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->input('file');
        $filename = $request->file->getClientOriginalName();

        if ($request->hasFile('file')) {

            $material = new Material;
            $material->name = $request->input('name');
            $material->description = $request->input('description');
            $material->file_name = rand(111, 99999).$filename;
            $request->file->storeAs('materials', $material->file_name);
            $material->subject_id = $request->input('subject');
            $material->save();

            return redirect()->route('materials.index');
        }

    }


    /**
     * Download material from storage
     *
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function downloadFile($name)
    {
        return response()->download(storage_path("app/materials/{$name}"));
    }


    /**
     * Delete material
     *
     * @param  Materil $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materil $material)
    {
        $material->delete();
        unlink(storage_path('app/materials/'.$material->fileName));
        $message = "Usunięto materiał";

        return response()->json(['success' => $message]);

    }


}
