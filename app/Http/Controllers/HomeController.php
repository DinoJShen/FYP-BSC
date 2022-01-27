<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Classgroup;
use App\Models\Feedback;
use App\Models\LogActivity as ModelsLogActivity;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $logedin = auth()->user()->id;
        $logs = ModelsLogActivity::latest()->take(5)->get();
        $totalusers = DB::select("SELECT COUNT(*) FROM users");
        $totalgroups = DB::select("SELECT COUNT(*) FROM classgroups");
        $totalgroupsjoined = DB::select("SELECT COUNT(*) FROM groupmembers WHERE user_id = '$logedin'");
        $totalfeedbacks = DB::select("SELECT COUNT(*) FROM feedbacks");
        $users = User::select("*")
            ->whereNotNull('last_seen')
            ->orderBy('last_seen', 'DESC')
            ->paginate(10);

        $year = ['2019','2020','2021','2022'];
        $studentRegistered = [];
        $teacherRegistered = [];
        $rating =[];
        $students = User::role('Student')->get();
        $teachers = User::role('Teacher')->get();

        $rate = ['5','4','3','2','1'];
        foreach ($rate as $key => $value) {
            $rating[] = Feedback::where('rate',$value)->count();
        }

        foreach ($year as $key => $value) {
            $filterStudent = $students->filter(function ($filter) use ($value){
                return $filter->created_at->year === (int)$value; 
            });
            $filterTeacher = $teachers->filter(function ($filter) use ($value){
                return $filter->created_at->year === (int)$value; 
            });
            $studentRegistered[] = $filterStudent->count();
            $teacherRegistered[] = $filterTeacher->count();
        }

        return view('dashboard', ['totalusers' => $totalusers, 'totalgroups' => $totalgroups, 
        'totalgroupsjoined' => $totalgroupsjoined,
        'totalfeedbacks' => $totalfeedbacks, 'users' => $users, 'year' => json_encode($year,JSON_NUMERIC_CHECK), 
        'studentRegistered' => json_encode($studentRegistered,JSON_NUMERIC_CHECK), 
        'teacherRegistered' => json_encode($teacherRegistered,JSON_NUMERIC_CHECK),
        'rating' => json_encode($rating,JSON_NUMERIC_CHECK),'logs' => $logs]);
    }

    public function logActivity()
    {
        $logs = LogActivity::logActivityLists();
        return view('pages.logActivity', compact('logs'));
    }
}
