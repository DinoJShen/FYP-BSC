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
                        <h3 class="mb-0 ml-1">{{ __('Edit Post') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="/posts/{{$post->id}}" autocomplete="off">

                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">{{ __('Post information') }}</h6>

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Title') }}</label>
                            <input type="text" name="title" id="input-name" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{$post->title}}" required autofocus>

                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-admin">{{ __('Description') }}</label>
                            <input type="text" name="description" id="input-name" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Detail') }}" value="{{$post->detail}}" required autofocus>
                        </div>

                        <div class="text-center">

                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                    </form>
                    <form method="post" action="/posts/{{$post->id}}" style="display:inline;" >
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