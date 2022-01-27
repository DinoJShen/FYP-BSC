<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\ClassGroup;
use App\Models\Submission;
use DB;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class GroupController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:group-list|group-create|group-edit|group-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:group-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:group-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:group-delete', ['only' => ['destroy']]);
    }

    public function leavegroup(Request $request)
    {
        $groupid = $request->group;
        DB::table('groupmembers')->where('group_id',$groupid)
                                ->where('user_id',auth()->user()->id)->delete();
        LogActivity::addToLog('User (id: '.auth()->user()->id.') leaved a group (id: '.$groupid.')');
        return redirect('/joingroup')->withErrors(['msg' => 'Successfully leaved group']);;
    }


    public function joingroup(Request $request)
    {
        $groupid = $request->code;
        $validate = DB::table('groupmembers')->where('group_id',$groupid)->where('user_id',auth()->user()->id)->get();
        if ($validate->isEmpty()){
            DB::table('groupmembers')->insert([
                'group_id' => $groupid,
                'user_id' => auth()->user()->id,
            ]);
            LogActivity::addToLog('User (id: '.auth()->user()->id.') joined a group (id: '.$groupid.')');
            return redirect('/joingroup')->withErrors(['msg' => 'Successfully joined group']);;
        }
        else {
            return redirect('/joingroup')->withErrors(['msg' => 'You already joined this group !']);;
        }
        
    }

    public function memberlist(Request $request)
    {
        $groupid = $request->group;
        $members  = DB::select("SELECT users.username,users.last_seen,users.id FROM groupmembers JOIN users ON groupmembers.user_id = users.id WHERE groupmembers.group_id = '$groupid'");
        return view('groups.memberlist', ['members' => $members]);
    }

    public function assignments(Request $request)
    {
        $groupid = $request->group;
        $assignments  = Assignment::where('group_id', $groupid)->get();
        $userSubmission = Submission::where('upload_from', auth()->user()->id)->get();
        return view('groups.assignments', ['assignments' => $assignments, 'userSubmission' => $userSubmission]);

    }

    public function convo(Request $request)
    {
        $groupid = $request->group;
        $group = ClassGroup::find($groupid);
        $posts  = DB::select("SELECT posts.id,posts.title,posts.detail,posts.created_at,posts.updated_at,users.username FROM posts JOIN users ON posts.createdby = users.id WHERE posts.group_id = '$groupid' ORDER BY posts.id DESC");
        return view('groups.convo', ['posts' => $posts, 'groupid' => $groupid, 'group' => $group]);
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        if (auth()->user()->hasRole('Admin')){
            $groups = DB::select('select classgroups.id,classgroups.groupname,users.username,classgroups.created_at from classgroups inner join users on classgroups.admin=users.id');
        }else{
            $groups = DB::select("select classgroups.id,classgroups.groupname,users.username,classgroups.created_at from classgroups inner join users on classgroups.admin=users.id where classgroups.admin = '$user_id'");
        }
        return view('groups.index', ['groups' => $groups]);
    }

    public function create()
    {
        $users = DB::select('select * from users');
        return view('groups.create', ['users' => $users]);
    }

    public function store()
    {
        request()->validate([
            'groupname' => 'required',
        ]);

        $groupid = ClassGroup::create([
            'groupname' => request('groupname'),
            'admin' => auth()->user()->id,
        ]);
        $validate = DB::table('groupmembers')->where('group_id',$groupid)->where('user_id',auth()->user()->id)->get();
        if ($validate->isEmpty()){
            DB::table('groupmembers')->insert(
                ['user_id' => auth()->user()->id, 'group_id' => $groupid->id]
            );
        }
        LogActivity::addToLog('User created a group (id: '.$groupid.')');
        return redirect('/groups');
    }

    public function edit(ClassGroup $group)
    {
        $users = DB::select('select * from users');
        return view('groups.edit', ['group' => $group], ['users' => $users]);
    }

    public function update(ClassGroup $group)
    {
        request()->validate([
            'groupname' => 'required',
            'admin' => 'required',
        ]);
        $group->update([
            'groupname' => request('groupname'),
            'admin' => request('admin'),
        ]);
        $validate = DB::table('groupmembers')->where('group_id',$group->id)->where('user_id',request('admin'))->get();
        if ($validate->isEmpty()){
            DB::table('groupmembers')->insert(
                ['user_id' => request('admin'), 'group_id' => $group->id]
            );
        }
        LogActivity::addToLog('User edited a group (id: '.$group->id.')');
        return redirect('/groups')->withErrors(['msg' => 'Successfully updated group profile']);
    }

    public function destroy(ClassGroup $group)
    {
        $group->delete();
        LogActivity::addToLog('User deleted a group (id: '.$group->id.')');
        return redirect('/groups')->withErrors(['msg' => 'Successfully deleted group profile']);
    }
}
