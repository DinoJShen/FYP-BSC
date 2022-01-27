@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->name,
'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0 ml-1">{{ __('Add Group') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="/groups/{{$group->id}}" autocomplete="off">

                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">{{ __('Group information') }}</h6>

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        <div class="form-group{{ $errors->has('groupname') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Group Name') }}</label>
                            <input type="text" name="groupname" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Group Name') }}" value="{{$group->groupname}}" required autofocus>

                            @if ($errors->has('groupname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('groupname') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('admin') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-admin">{{ __('Admin') }}</label>
                            <select name="admin" id="listUser" class="form-control" multiple required>
                                @foreach($users as $key => $data)
                                <option value="{{$data->id}}" class="form-control">{{$data->username}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center">

                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                    </form>
                    <form method="post" action="/groups/{{$group->id}}" style="display:inline;" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Confirm to delete?')" class="btn btn-danger mt-4">{{ __('DELETE') }}</button>
                    </form>
                </div>

                <hr class="my-4" />
            </div>
        </div>
    </div>
</div>

@include('layouts.footers.auth')
</div>
@endsection