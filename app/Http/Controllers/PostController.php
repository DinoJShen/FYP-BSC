<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{

    public function index(){
        $posts = DB::select('select posts.title,posts.detail,posts.id,users.username from posts inner join users on posts.createdby=users.id');
        return view('posts.index',['posts'=>$posts]);
    }

    public function create(){
        $users = DB::select('select id,username from users');
        $groups = DB::select('select id,groupname from classgroups');
        return view('posts.create',['users' => $users,'groups' => $groups]);
    }

    public function store(){
        request()->validate([
            'title' => 'required',
            'detail' => 'required',
            'group' => 'required',
        ]);

        $postid = Post::create([
            'title' => request('title'),
            'detail' => request('detail'),
            'createdby' => auth()->user()->id,
            'group_id' => request('group'),
        ]);
        LogActivity::addToLog('User created a post (id:'.$postid->id.') in a group (id: '. request('group') .')');
        return Redirect::refresh();
        return response()->json(['success'=>'Ajax request submitted successfully']);
    }

    public function edit(Post $post){
        return view('posts.edit',['post' => $post]);
    }

    public function update(Post $post){
        request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $post->update([
            'title' => request('title'),
            'detail' => request('description'),
        ]);

        LogActivity::addToLog('User updated a post (id:'.$post->id.') in a group (id: '. $post->group_id .')');
        return redirect('/groups/'. $post->group_id .'/convo')->withErrors(['msg' => 'Successfully updated post']);;

    }

    public function destroy(Post $post){
        $post->delete();
        LogActivity::addToLog('User deleted a post (id:'.$post->id.') in a group (id: '. $post->group_id .')');
        return redirect('/groups/'. $post->group_id .'/convo')->withErrors(['msg' => 'Successfully deleted post']);;
    }
}
