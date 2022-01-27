<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
</head>
<?php

use App\Http\Controllers\CommentController; ?>

<body class="clickup-chrome-ext_installed">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('layouts.navbars.sidebar')
    <div class="main-content">
        @include('layouts.navbars.navs.auth')
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
            <div class="container-fluid">
                <div class="header-body">
                    <button type="button" class="btn btn-success mb-2">
                        <span>Group Invitation Code:</span>
                        <span class="badge">{{$group->id}}</span>
                    </button>
                    
                        <a class="btn btn-danger my-3" href="/groups/{{$group->id}}/leave" role="button" onclick="return confirm('Confirm to leave?')">Leave Group</a>

                    <!-- Card stats -->
                    <div class="row justify-content-center">
                        <div class="col ">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">{{$group->groupname}}</h5>
                                            <span class="h2 font-weight-bold mb-0">Assignment</span>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-warning btn-sm mt-2" onClick="location.href='/groups/{{$groupid}}/assignments'">Take me there</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">{{$group->groupname}}</h5>
                                            <span class="h2 font-weight-bold mb-0">Textbook</span>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-warning btn-sm mt-2" onClick="location.href='/textbook'">Take me there</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt--7 ">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary btn-block " data-toggle="modal" data-target="#postModal">
                Write a new discussion...
            </button>
            <!-- Modal -->
            <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Discussion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="post-form">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Title</span>
                                    </div>
                                    <input type="text" class="form-control text-dark" placeholder="Title" name="title" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Detail</span>
                                    </div>
                                    <textarea class="form-control text-dark" aria-label="Detail" name="detail" required></textarea>
                                </div>
                                {{ Form::hidden('group', $groupid) }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" id="post-button" class="btn btn-primary">Post</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @if($errors->any())
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-text"> {{$errors->first()}}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @endif
            <div id="forum">
                @foreach($posts as $key => $data)
                <div class="card shadow m-2">
                    <div class="card-header border-0">
                        <div class="float-right">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="/posts/{{ $data->id }}/edit">Edit</a>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg">
                                    </span>
                                    <div class="media-body ml-2 d-block">
                                        <span class="mb-0 text-sm  font-weight-bold">{{ $data->username }}</span>
                                        <br>{{$data->updated_at}}
                                    </div>
                                </div>

                                <h3 class="mb-0 mt-2">{{$data->title}}</h3>
                                {{$data->detail}}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            <div class="container">
                                @php
                                $comments = CommentController::getComment($data->id);
                                @endphp
                                @foreach($comments as $comment)
                                @php
                                $owner = CommentController::getOwner($comment->id);
                                @endphp
                                <div class="media ml-4">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg">
                                    </span>
                                    <div class="media-body ml-2 d-block">

                                        <span class="mb-0 text-sm  font-weight-bold">{{$owner}}</span>
                                        <br>{{$comment->created_at}}
                                        <h5 class="mb-2">{{ $comment->content }}</h5>
                                    </div>
                                </div>
                                @endforeach
                                <form id="comment-form">
                                    @csrf
                                    <div class="coment-bottom bg-white p-2 px-4">
                                        <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                                            <input type="text" class="form-control mr-3 comment-content" name="comment" placeholder="Add comment">
                                            <input type="hidden" name="postid" class="postid" value="{{$data->id}}">
                                            <button type="button" class="btn btn-primary comment-button">Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </nav>
                    </div>
                </div>
                @endforeach
            </div>

            <footer class="footer">
                <div class="row align-items-center justify-content-xl-between">
                    <div class="col-xl-6">

                    </div>
                    <div class="col-xl-6">

                    </div>
                </div>
            </footer>
        </div>
    </div>


    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#post-button").click(function(event) {
            event.preventDefault();

            let title = $("input[name=title]").val();
            let detail = $("textarea[name=detail]").val();
            let group = $("input[name=group]").val();
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/posts",
                type: "POST",
                data: {
                    title: title,
                    detail: detail,
                    group: group,
                },
                success: function(response) {
                    console.log(response);
                    if (response) {
                        $('.success').text(response.success);
                        $("#post-form")[0].reset();
                    }
                    $("#forum").load(location.href + " #forum>*", "");
                    $("#closeModal").trigger("click");
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $(document).on('click', '.comment-button', function(event) {
            event.preventDefault();

            let form = $(this).closest("form");
            let comment = form.find("input[name=comment]").val();
            let post = form.find("input[name=postid]").val();
            let _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/comments",
                type: "POST",
                data: {
                    content: comment,
                    post_id: post,
                },
                success: function(response) {
                    console.log(response);
                    if (response) {
                        $('.success').text(response.success);
                        $("#comment-form")[0].reset();
                    }
                    $("#forum").load(location.href + " #forum>*", "");
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
</body>

</html>