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
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Member List</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">User</th>
                    <th scope="col" class="sort" data-sort="budget">Status</th>
                    <th scope="col" class="sort" data-sort="status">Last Seen</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach($members as $key => $data)
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">

                          <span class="name mb-0 text-sm">{{$data->username}}</span>

                        </div>
                      </div>
                    </th>

                    <td>
                      <span class="badge badge-dot mr-4">
                        <i class="bg-warning"></i>
                        @if(Cache::has('user-is-online-' . $data->id))
                        <span class="text-success">Online</span>
                        @else
                        <span class="text-danger">Offline</span>
                        @endif</span>

                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="completion mr-2">{{ Carbon\Carbon::parse($data->last_seen)->diffForHumans() }}</span>
                        @endforeach
                      </div>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            
          </div>
        </div>
      </div>
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