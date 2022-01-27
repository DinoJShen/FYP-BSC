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
                        <h3 class="mb-0">{{ __('Add Group') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('roles.store') }}" autocomplete="off">
                        @csrf

                        <h6 class="heading-small text-muted mb-4">{{ __('Role information') }}</h6>

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('rolename') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Role Name') }}</label>
                                <input type="text" name="rolename" id="input-name" class="form-control form-control-alternative{{ $errors->has('rolename') ? ' is-invalid' : '' }}" placeholder="{{ __('Role Name') }}" value="" required autofocus>

                                @if ($errors->has('rolename'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('rolename') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('permission') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-permission">{{ __('Permission') }}</label>
                                <br/>
                                @foreach($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                    {{ $value->name }}</label>
                                <br />
                                @endforeach
                                @if ($errors->has('permission'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('permission') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                    <hr class="my-4" />
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection