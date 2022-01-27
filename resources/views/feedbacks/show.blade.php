@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Hello') . ' '. auth()->user()->name,
'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
'class' => 'col-lg-7'
])
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<style>
    div.stars {
        width: 270px;
    }

    input.star {
        display: none;
    }

    label.star {
        float: right;
        padding: 10px;
        font-size: 36px;
        color: #444;
        transition: all .2s;
    }

    input.star:checked~label.star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s;
    }

    input.star-5:checked~label.star:before {
        color: #FE7;
        text-shadow: 0 0 20px #952;
    }

    input.star-1:checked~label.star:before {
        color: #F62;
    }

    label.star:hover {
        transform: rotate(-15deg) scale(1.3);
    }

    label.star:before {
        content: '\f006';
        font-family: FontAwesome;
    }
</style>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0 ml-1">{{ __('Feedback Information') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="" autocomplete="off">
                        <h6 class="heading-small text-muted mb-4">{{ __('Feedback information') }}</h6>

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
                            <input type="text" name="title" id="input-name" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{$feedback->title}}" readonly>

                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-admin">{{ __('Description') }}</label>
                            <input type="text" name="description" id="input-name" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Detail') }}" value="{{$feedback->description}}" readonly>
                        </div>
                        <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-admin">{{ __('Created date') }}</label>
                            <input type="text" name="date" id="input-name" class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="{{ __('Date') }}" value="{{$feedback->created_at}}" readonly>
                        </div>
                        <div class="form-group{{ $errors->has('star') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-star">{{ __('Rate') }}</label>
                            <div class="stars">
                                @if($feedback->rate == 5)
                                <input class="star star-5" id="star-5" type="radio" name="star" checked disabled/>
                                <label class="star star-5" for="star-5"></label>
                                @else
                                <input class="star star-5" id="star-5" type="radio" name="star" disabled/>
                                <label class="star star-5" for="star-5"></label>
                                @endif
                                @if($feedback->rate == 4)
                                <input class="star star-4" id="star-4" type="radio" name="star" checked disabled/>
                                <label class="star star-4" for="star-4"></label>
                                @else
                                <input class="star star-4" id="star-4" type="radio" name="star" disabled/>
                                <label class="star star-4" for="star-4"></label>
                                @endif
                                @if($feedback->rate == 3)
                                <input class="star star-3" id="star-3" type="radio" name="star" checked disabled/>
                                <label class="star star-3" for="star-3"></label>
                                @else
                                <input class="star star-3" id="star-3" type="radio" name="star" disabled/>
                                <label class="star star-3" for="star-3"></label>
                                @endif
                                @if($feedback->rate == 2)
                                <input class="star star-2" id="star-2" type="radio" name="star" checked disabled/>
                                <label class="star star-2" for="star-2"></label>
                                @else
                                <input class="star star-2" id="star-2" type="radio" name="star" disabled/>
                                <label class="star star-2" for="star-2"></label>
                                @endif
                                @if($feedback->rate == 1)
                                <input class="star star-1" id="star-1" type="radio" name="star" checked disabled/>
                                <label class="star star-1" for="star-1"></label>
                                @else
                                <input class="star star-1" id="star-1" type="radio" name="star" disabled/>
                                <label class="star star-1" for="star-1"></label>
                                @endif
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="{{ url()->previous() }}" class="btn btn-info" role="button">Back</a>
                        </div>
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