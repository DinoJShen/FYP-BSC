<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Feedback;
use Illuminate\Http\Request;
use DB;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = DB::table('feedbacks')->join('users', 'feedbacks.user_id', '=', 'users.id')
                                            ->select('feedbacks.title','feedbacks.description','feedbacks.id','users.username','feedbacks.rate','feedbacks.created_at')
                                            ->paginate(5);
        return view('feedbacks.index',['feedbacks'=>$feedbacks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feedbacks.create');
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
            'description' => 'required',
            'star' => 'required',
        ]);

        $feedback = Feedback::create([
            'title' => request('title'),
            'description' => request('description'),
            'user_id' => auth()->user()->id,
            'rate' => request('star'),
        ]);
        LogActivity::addToLog('User sent a feedback (id: '.$feedback->id.')');
        return redirect('/feedbacks/create')->withErrors(['msg' => 'Successfully sent the feedback to admin!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        return view('feedbacks.show', ['feedback' => $feedback]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
