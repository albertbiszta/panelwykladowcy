<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Session;
use App\Subject;
use App\Syllabus;
use App\User;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{


    /**
     * Add syllabus form
     *
     * @param  Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function create(Subject $subject)
    {
        if ($subject->user == Auth::user()) {
            return view('syllabuses.create')->with(compact('subject'));
        } else {
            abort(404);
        }
    }


    /**
     * Save syllabus
     *
     * @param  Request $request
     * @param  Subject $subject
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Subject $subject)
    {
        if ($subject->user == Auth::user()) {
            $syllabus = new Syllabus($request->all());
            $syllabus->subject()->associate($id);
            $syllabus->save();
            $message = "Dodano syllabus";

            return redirect()->route('subjects.show', [$id])->with('flash_message_success', $message);
        } else {
            abort(404);
        }

    }


    /**
     * @param Syllabus $syllabus
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Syllabus $syllabus)
    {
        if ($syllabus->subject->user == Auth::user()) {
            $syllabus->delete();
            $message = 'Usunięto syllabus';

            return response()->json(['success' => $message]);
        }

    }


    /**
     * Edit syllabus form
     *
     * @param Syllabus $syllabus
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Syllabus $syllabus)
    {
        if ($syllabus->subject->user == Auth::user()) {
            return view('syllabuses.edit')->with(compact('syllabus'));
        } else {
            abort(404);
        }
    }

    /**
     * Update syllabus
     *
     * @param  Request $request
     * @param  Syllabus $syllabus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Syllabus $syllabus)
    {
        if ($syllabus->subject->user == Auth::user()) {
            $syllabus->update($request->all());
            $message = "Zapisano zmiany";

            return redirect()->route('subjects.show', [$syllabus->subject])->with('flash_message_success', $message);
        } else {
            abort(404);
        }

    }


}
