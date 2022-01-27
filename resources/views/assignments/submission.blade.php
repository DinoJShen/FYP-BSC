@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->username,
'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Submission') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="/submissions" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <h6 class="heading-small text-muted mb-4">{{ __('Assignments information') }}</h6>
                        @if($errors->any())
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text"> {{$errors->first()}}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @endif
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Title') }}</label>
                                <input type="text" name="title" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{$assignment->title}}" required readonly>

                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                            {{ Form::hidden('assignment_id', $assignment->id) }}
                            <div class="form-group{{ $errors->has('detail') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-detail">{{ __('Detail') }}</label>
                                <input type="text" name="detail" id="input-name" class="form-control form-control-alternative{{ $errors->has('detail') ? ' is-invalid' : '' }}" placeholder="{{ __('Detail') }}" value="{{$assignment->description}}" required readonly>
                            </div>
                            <div class="form-group{{ $errors->has('duedate') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-group">{{ __('Due Date') }}</label>
                                <input class="date form-control" type="text" name="duedate" value="{{$assignment->dueDate}}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="input-group">{{ __('Reference Material') }}</label>
                                <div class="alert alert-primary" role="alert">
                                    <a class="text-white" href="/assignments/{{$assignment->id}}/download">{{$assignment->file_name}}</a>
                                </div>

                            </div>
                            <div class="form-group{{ $errors->has('file') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-group">{{ __('My work') }}</label>
                                @foreach($submission as $key => $data)
                                <div class="alert alert-default alert-dismissible fade show" role="alert">
                                    <span class="alert-inner--text"><a class="text-white" href="/submissions/{{$data->id}}/download">{{$data->file_name}}</a></span>
                                    <div class="dropright">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="/submissions/{{ $data->id }}/delete">Remove</a>
                                        </div>
                                    </div>
                                    @if (isset($data->return_path))
                                    <span class="alert-inner--text"><a class="text-success" href="/submissions/{{$data->id}}/downloadReturn">Returned! {{$data->return_name}}</a></span>
                                    @endif
                                </div>
                                @endforeach
                                <input type="file" name="file" class="form-control" required>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Turn in') }}</button>
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