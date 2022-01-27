@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->username,
'description' => __('This is your return page. You can return a submission that was uploaded by user'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Return to student') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="/submissions/{{$submission->id}}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <h6 class="heading-small text-muted mb-4">{{ __('Submission information') }}</h6>

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if($errors->any())
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text"> {{$errors->first()}}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @endif

                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Submission') }}</label>
                                <div class="alert alert-default alert-dismissible fade show" role="alert">
                                    <span class="alert-inner--text">
                                        <a class="text-white" href="/submissions/{{$submission->id}}/download">
                                            <span class="alert-inner--text">{{$submission->file_name}}
                                        </a>
                                    </span>
                                </div>
                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('detail') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-detail">{{ __('Submit From') }}</label>
                                <input type="text" name="detail" id="input-name" class="form-control form-control-alternative{{ $errors->has('detail') ? ' is-invalid' : '' }}" placeholder="{{ __('Submit From') }}" value="{{$submit_from}}" required autofocus readonly>
                            </div>
                            @if ($errors->has('group'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('group') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('duedate') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-group">{{ __('Upload Date') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="date form-control" type="text" name="duedate" value="{{$submission->updated_at}}" readonly>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('file') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-file">{{ __('Return') }}</label>
                                @if (isset($submission->return_name))
                                <div class="alert alert-default alert-dismissible fade show" role="alert">
                                    <span class="alert-inner--text"><a class="text-white" href="/submissions/{{$submission->id}}/downloadReturn">{{$submission->return_name}}</a></span>
                                    <div class="dropright">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="/submissions/{{ $submission->id }}/deleteReturn">Remove</a>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <input type="file" name="file" class="form-control" required>
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