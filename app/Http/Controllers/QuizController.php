<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Quiz;
use Illuminate\Http\Request;
use DB;

class QuizController extends Controller
{

    
    public function showQuiz(Request $request){
        $quizlvl = $request->lvl;
        $quizzes  = DB::select("SELECT * FROM quizzes WHERE quizzes.level = '$quizlvl'");
        return view('quiz.display',['quizzes'=>$quizzes]);
    }

    public function index()
    {
        $quiz = Quiz::paginate(5);
        return view('quiz.index',['quiz'=>$quiz]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'correctoption' => 'required',
            'level' => 'required',
        ]);
    
        $quiz = Quiz::create($request->all());
        LogActivity::addToLog('User created a quiz (id: '. $quiz->id .')');
        return redirect('/quiz')->withErrors(['msg'=>'Quiz created successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        return view('quiz.edit',['quiz' => $quiz]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'correctoption' => 'required',
        ]);
    
        $quiz->update($request->all());
        LogActivity::addToLog('User updated a quiz (id: '. $quiz->id .')');
        return redirect('/quiz')->withErrors(['msg'=>'Quiz updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        LogActivity::addToLog('User deleted a quiz (id: '. $quiz->id .')');
        return redirect('/quiz')->withErrors(['msg'=>'Quiz deleted successfully']);
    }
}
