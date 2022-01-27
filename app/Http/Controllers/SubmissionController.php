<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $submission = Submission::where('assignment_id', $request->assignment_id)
            ->where('upload_from', auth()->user()->id)
            ->get();
        $assignment = Assignment::find($request->assignment_id);
        return view('assignments.submission', ['assignment' => $assignment, 'submission' => $submission]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'assignment_id' => 'required',
            'file' => 'required',
        ]);

        $uploadedFile = $request->file('file');
        $fileName = $uploadedFile->getClientOriginalName();
        //$request->file->move(public_path('assignment_file'), $fileName);
        $path = $request->file('file')->store('submission_file');

        $submission = Submission::create([
            'assignment_id' => request('assignment_id'),
            'upload_from' => auth()->user()->id,
            'file_name' => $fileName,
            'file_path' => $path,
        ]);
        LogActivity::addToLog('User submitted a submission (id: '.$submission->id.') to assignment (id: '.request('assignment_id').')');
        return back()->withErrors(['msg' => 'Successfully turned in']);;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function show(Submission $submission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function edit(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submission $submission)
    {
        request()->validate([
            'file' => 'required',
        ]);
        $uploadedFile = $request->file('file');
        $fileName = $uploadedFile->getClientOriginalName();
        //$request->file->move(public_path('assignment_file'), $fileName);
        $path = $request->file('file')->store('return_file');

        $submission->return_name = $fileName;
        $submission->return_path = $path;
        $submission->save();

        LogActivity::addToLog('User returned a submission (id: '.$submission->id.')');
        return Redirect::back()->withErrors(['msg' => 'Successfully returned to student!']);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $submission = Submission::find($request->id);
        unlink(storage_path('app/' . $submission->file_path));
        if (isset($submission->return_path)){
            unlink(storage_path('app/' . $submission->return_path));
        }
        $submission->delete();
        LogActivity::addToLog('User deleted a submission (id: '.$submission->id.')');
        return redirect()->back()->withErrors(['msg' => 'Successfully deleted submission']);
    }

    public function deleteReturn(Request $request)
    {
        $submission = Submission::find($request->id);
        unlink(storage_path('app/' . $submission->return_path));
        $submission->return_path = null;
        $submission->return_name = null;
        $submission->save();
        LogActivity::addToLog('User deleted a return of submission (id: '.$submission->id.')');
        return redirect()->back()->withErrors(['msg' => 'Successfully deleted return file']);
    }

    public function downloadFile(Request $request)
    {
        $file_id = $request->file_id;
        $file = Submission::find($file_id);

        LogActivity::addToLog('User downloaded a submission file (id: '.$file_id.')');
        return response()->download(storage_path('app/' . $file->file_path), $file->file_name);
    }

    public function return(Request $request)
    {
        $submission = Submission::find($request->id);
        $submit_from = $submission->user->username;
        return view('assignments.return', ['submission' => $submission, 'submit_from' => $submit_from]);
    }

    public function downloadReturnFile(Request $request)
    {
        $file_id = $request->file_id;
        $file = Submission::find($file_id);

        LogActivity::addToLog('User downloaded a return file (id: '.$file_id.')');
        return response()->download(storage_path('app/' . $file->return_path), $file->return_name);
    }
}
