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
                    <!-- Card stats -->
                    
                </div>
            </div>
        </div>
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">User Log Activity</h3>
                                </div>
                                <!-- <div class="col-4 text-right">
                                    <a href="" class="btn btn-sm btn-primary">Filter</a>
                                </div> -->
                            </div>
                        </div>

                        <div class="col-12">
                        </div>
                        @if($errors->any())
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text"> {{$errors->first()}}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @endif
                        <div class="table-responsive table-hover">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">URL</th>
                                        <th scope="col">Method</th>
                                        <th scope="col">IP</th>
                                        <th scope="col">User Agent</th>
                                        <th scope="col">User ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($logs as $key => $data)
                                        <th>{{++$key}}</th>
                                        <th>{{$data->subject}}</th>
                                        <th class="text-success">{{$data->url}}</th>
                                        <th><span class="badge badge-info">{{ $data->method }}</span></th>
                                        <th class="text-warning">{{$data->ip}}</th>
                                        <th class="text-danger">{{$data->agent}}</th>
                                        <th>{{$data->user_id}}</th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">
                                {!! $logs->links() !!}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                
            </footer>
        </div>
    </div>


    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
</body>

</html>