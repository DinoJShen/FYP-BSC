<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Assignment;
use App\Models\Classgroup;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:assignment-list|assignment-create|assignment-edit|assignment-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:assignment-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:assignment-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:assignment-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        if (auth()->user()->hasRole('Admin')){
            $assignments = Assignment::All();
            return view('assignments.index', ['assignments' => $assignments]);
        }else if(auth()->user()->hasRole('Teacher')){
            $assignments = Assignment::where('createdby',$user_id)->get();
            return view('assignments.index', ['assignments' => $assignments]);
        }else{
            $groupsjoined = DB::select("SELECT classgroups.groupname,classgroups.id FROM groupmembers 
            JOIN classgroups ON groupmembers.group_id = classgroups.id WHERE groupmembers.user_id = '$user_id'");
            $assignments = collect();
            foreach ($groupsjoined as $group){
                $assignmentInGroup = Assignment::where('group_id', $group->id)->get();
                $assignments = $assignments->merge($assignmentInGroup);
            }
            $userSubmission = Submission::where('upload_from', auth()->user()->id)->get();
            return view('groups.assignments', ['assignments' => $assignments, 'userSubmission' => $userSubmission]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Classgroup::where('admin',auth()->user()->id)->get();
        return view('assignments.create', ['groups' => $groups]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'detail' => 'required',
            'group' => 'required',
        ]);

        if ($request->has('file')) {
            $uploadedFile = $request->file('file');
            $fileName = $uploadedFile->getClientOriginalName();
            //$request->file->move(public_path('assignment_file'), $fileName);
            $path = $request->file('file')->store('assignment_file');

            $assignmentid = Assignment::create([
                'title' => request('title'),
                'description' => request('detail'),
                'createdby' => auth()->user()->id,
                'group_id' => request('group'),
                'dueDate' => request('duedate'),
                'file_name' => $fileName,
                'file_path' => $path,
            ]);
        } else {
            $assignmentid = Assignment::create([
                'title' => request('title'),
                'description' => request('detail'),
                'createdby' => auth()->user()->id,
                'group_id' => request('group'),
                'dueDate' => request('duedate'),
            ]);
        }
        LogActivity::addToLog('User created an assignment (id: '.$assignmentid->id.')');
        return redirect('/assignments')->withErrors(['msg' => 'Successfully created assignment']);;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        $submissions = Submission::where('assignment_id',$assignment->id)->get();
        return view('assignments.show', ['assignment' => $assignment,'submissions' => $submissions]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        return view('assignments.edit', ['assignment' => $assignment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $assignment->update([
            'title' => request('title'),
            'detail' => request('description'),

        ]);
        if ($request->filled('duedate')) {
            $assignment->update([
                'dueDate' => request('duedate'),
            ]);
        }
        LogActivity::addToLog('User edited an assignment (id: '.$assignment->id.')');
        return redirect('/assignments')->withErrors(['msg' => 'Successfully updated assignment']);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        $assignment->delete();
        LogActivity::addToLog('User deleted an assignment (id: '.$assignment->id.')');
        return redirect('/assignments')->withErrors(['msg' => 'Successfully deleted assignment profile']);
    }

    public function downloadFile(Request $request)
    {
        $file_id = $request->file_id;
        $file = Assignment::find($file_id);

        LogActivity::addToLog('User downloaded an assignment file (id: '.$file_id.')');
    	return response()->download(storage_path('app/' . $file->file_path), $file->file_name);
    }
}
