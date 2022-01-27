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
                        <h3 class="mb-0">{{ __('Add ASSIGNMENTS') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="/assignments" autocomplete="off" enctype="multipart/form-data">
                        @csrf

                        <h6 class="heading-small text-muted mb-4">{{ __('Assignments information') }}</h6>

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
                                <input type="text" name="title" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="" required autofocus>

                                @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('detail') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-detail">{{ __('Detail') }}</label>
                                <input type="text" name="detail" id="input-name" class="form-control form-control-alternative{{ $errors->has('detail') ? ' is-invalid' : '' }}" placeholder="{{ __('Detail') }}" value="" required autofocus>
                            </div>
                            <div class="form-group{{ $errors->has('group') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-group">{{ __('Group') }}</label>
                                <select name="group" id="listGroup" class="form-control" multiple required>
                                    @foreach($groups as $key => $data)
                                    <option value="{{$data->id}}" class="form-control">{{$data->groupname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('group'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('group') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('duedate') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-group">{{ __('Due Date') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="date form-control" type="text" name="duedate" readonly>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('file') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-file">{{ __('Reference') }}</label>
                                <input type="file" name="file" class="form-control">
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
<script type="text/javascript">
    $('.date').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>
@endsection