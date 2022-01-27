<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $users = User::select("*")
            ->whereNotNull('last_seen')
            ->orderBy('last_seen', 'DESC')
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', ['user' => $user, 'roles' => $roles, 'userRole' => $userRole]);
    }

    public function update(User $user)
    {
        request()->validate([
            'username' => 'required',
            'email' => 'required',
            'roles' => 'required',
        ]);
        $user->update([
            'username' => request('username'),
            'email' => request('email'),
        ]);

        DB::table('model_has_roles')->where('model_id', $user->id)->delete();

        $user->assignRole(request('roles'));

        return redirect('/user')->withErrors(['msg' => 'Successfully updated user profile']);;
    }

    public function destroy(User $user)
    {
        $user->delete();
        LogActivity::addToLog('Deleted User (id: ' . $user->id . ')');
        return redirect('/user')->withErrors(['msg' => 'Successfully deleted user profile']);
    }
}
