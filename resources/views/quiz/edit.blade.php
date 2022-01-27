@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->username,
'description' => __('This is quiz edit page. You can edit the quiz information here and update it in database'),
'class' => 'col-lg-7'
])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0 ml-1">{{ __('Update Quiz') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="/quiz/{{$quiz->id}}" autocomplete="off">

                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">{{ __('Quiz information') }}</h6>

                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif


                        <div class="form-group{{ $errors->has('question') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Question') }}</label>
                            <input type="text" name="question" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Question') }}" value="{{$quiz->question}}" required autofocus>

                            @if ($errors->has('question'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('question') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('option1') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Option 1') }}</label>
                            <input type="text" name="option1" id="input-name" class="form-control form-control-alternative{{ $errors->has('option') ? ' is-invalid' : '' }}" placeholder="{{ __('Option') }}" value="{{$quiz->option1}}" required>

                            @if ($errors->has('option'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('option') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('option2') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Option 2') }}</label>
                            <input type="text" name="option2" id="input-name" class="form-control form-control-alternative{{ $errors->has('option') ? ' is-invalid' : '' }}" placeholder="{{ __('Option') }}" value="{{$quiz->option2}}" required>

                            @if ($errors->has('option'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('option') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('option3') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Option 3') }}</label>
                            <input type="text" name="option3" id="input-name" class="form-control form-control-alternative{{ $errors->has('option') ? ' is-invalid' : '' }}" placeholder="{{ __('Option') }}" value="{{$quiz->option3}}" required>

                            @if ($errors->has('option'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('option') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('option4') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-name">{{ __('Option 4') }}</label>
                            <input type="text" name="option4" id="input-name" class="form-control form-control-alternative{{ $errors->has('option') ? ' is-invalid' : '' }}" placeholder="{{ __('Option') }}" value="{{$quiz->option4}}" required>

                            @if ($errors->has('option'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('option') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('correct') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-admin">{{ __('Correct Option') }}</label>
                            <select name="correctoption" id="correct" class="form-control" multiple required>
                                <option value="1" class="form-control">Option 1</option>
                                <option value="2" class="form-control">Option 2</option>
                                <option value="3" class="form-control">Option 3</option>
                                <option value="4" class="form-control">Option 4</option>
                            </select>
                        </div>
                        <div class="text-center">

                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                    </form>
                    <form method="post" action="/quiz/{{$quiz->id}}" style="display:inline;" >
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