<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>{{ config('app.name', 'BSC Dashboard') }}</title>
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
          <div class="row justify-content-center">
            <div class="col-xl-2 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Textbook</h5>
                      <span class="h2 font-weight-bold mb-0">Tingkatan 1</span>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn btn-default btn-sm mt-2" onClick="location.href='{{ route('textbook_t1') }}'">Take me there</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Textbook</h5>
                      <span class="h2 font-weight-bold mb-0">Tingkatan 2</span>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn btn-primary btn-sm mt-2" onClick="location.href='{{ route('textbook_t2') }}'">Take me there</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Textbook</h5>
                      <span class="h2 font-weight-bold mb-0">Tingkatan 3</span>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn btn-info btn-sm mt-2" onClick="location.href='{{ route('textbook_t3') }}'">Take me there</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Textbook</h5>
                      <span class="h2 font-weight-bold mb-0">Tingkatan 4</span>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn btn-success btn-sm mt-2" onClick="location.href='{{ route('textbook_t4') }}'">Take me there</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Textbook</h5>
                      <span class="h2 font-weight-bold mb-0">Tingkatan 5</span>
                    </div>
                    <div class="col-auto">
                      <button type="button" class="btn btn-warning btn-sm mt-2" onClick="location.href='{{ route('textbook_t5') }}'">Take me there</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-sm">
          <div class="card">
            <img class="card-img-top" src="../../assets/img/theme/img-1-1000x600.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Quiz Tingkatan 1</h5>
              <p class="card-text">Learn basic computer science subject at beginner level</p>
              <a href="/quiz/lvl/1" class="btn btn-primary">Start now</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="card">
            <img class="card-img-top" src="../../assets/img/theme/img-1-1000x600.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Quiz Tingkatan 2</h5>
              <p class="card-text">Try your knowledge level about basic computer science</p>
              <a href="/quiz/lvl/2" class="btn btn-primary">Start now</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="card">
            <img class="card-img-top" src="../../assets/img/theme/img-1-1000x600.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Quiz Tingkatan 3</h5>
              <p class="card-text">Do you really know basic computer science very well?</p>
              <a href="/quiz/lvl/3" class="btn btn-primary">Start now</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="card">
            <img class="card-img-top" src="../../assets/img/theme/img-1-1000x600.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Quiz Tingkatan 4</h5>
              <p class="card-text">Time to challenge yourself. Prove yourself with this quiz!</p>
              <a href="/quiz/lvl/4" class="btn btn-primary">Start now</a>
            </div>
          </div>
        </div>
        <div class="col-sm">
          <div class="card">
            <img class="card-img-top" src="../../assets/img/theme/img-1-1000x600.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Quiz Tingkatan 5</h5>
              <p class="card-text">Make yourself prepared for the examination</p>
              <a href="/quiz/lvl/5" class="btn btn-primary">Start now</a>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>