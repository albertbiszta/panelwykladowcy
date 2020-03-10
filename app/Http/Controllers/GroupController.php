<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Group;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    /**
     * List of groups + modals [Group CRUD]
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = User::find(Auth::user()->id)->groups;

        return view('groups.index')->with('groups', $groups);
    }


    /**
     * Save new group
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = new Group($request->all());
        if (empty($request->input('contact'))) {
            $group->contact = 'brak';
        }
        Auth::user()->groups()->save($group);
        $message = 'Dodano grupę';

        return response()->json(['success' => $message, 'group' => $group]);
    }


    /**
     * Update group data
     *
     * @param  Request $request
     * @param  Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        if ($group->user->id == Auth::user()->id) {
            $group->update($request->all());
            $message = "Zapisano zmiany";

            return response()->json(['success' => $message, 'group' => $group]);
        }
    }


    /**
     *  Delete group
     *
     * @param Group $group
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Group $group)
    {
        if ($group->user->id == Auth::user()->id) {
            $group->delete();
            $message = "Usunięto grupę";

            return response()->json(['success' => $message]);
        } else {
            $message = "Wystąpił błąd";

            return response()->json(['error' => $message]);
        }
    }


    /**
     * Details about group; Students belonging to this group
     *
     * @param Group $group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Group $group)
    {
        if ($group->user->id == Auth::user()->id) {
            $students = $group->students;

            return view('groups.show')->with(compact('group', 'students'));
        } else {
            abort(404);
        }
    }


    /**
     * @param Group $group
     * @return \Illuminate\Http\JsonResponse
     */
    public function userGroup(Group $group)
    {
        if ($group->user() == Auth::user()) {
            return response()->json(['success' => 'true', 'group' => $group]);
        } else {
            return response()->json(['error' => 'true']);
        }
    }


}
