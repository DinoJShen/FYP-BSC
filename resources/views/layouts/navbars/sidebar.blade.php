<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                @role('Admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logActivity') }}">
                        <i class="ni ni-align-left-2 text-muted"></i> {{ __('User Log') }}
                    </a>
                </li>
                @endrole
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="ni ni-single-02"></i>{{ __('User profile') }}
                    </a>
                </li>
                @role('Admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <i class="ni ni-circle-08 text-red"></i>{{ __('User Management') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('roles.index') }}">
                        <i class="ni ni-badge text-blue"></i>{{ __('Role Management') }}
                    </a>
                </li>
                @endrole
                @hasanyrole('Admin|Teacher')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('groups.index') }}">
                        <i class="ni ni-world text-green"></i>{{ __('Group Management') }}
                    </a>
                </li>
                @endhasanyrole
                <li class="nav-item">
                @hasanyrole('Admin|Teacher')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('quiz.index') }}">
                        <i class="ni ni-spaceship text-yellow"></i>{{ __('Quiz Management') }}
                    </a>
                </li>
                @endhasanyrole
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fab fa-laravel" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Groups') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            @foreach($groupsjoined as $key => $data)
                            <li class="nav-item">
                                <a class="nav-link" href="/groups/{{$data->id}}/convo">
                                    {{$data->groupname}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                @role('Student')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('textbook') }}">
                        <i class="ni ni-books"></i>{{ __('Textbook/Quiz') }}
                    </a>
                </li>
                @endrole
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('assignments.index') }}">
                        <i class="ni ni-collection text-warning"></i>{{ __('Assignment') }}
                    </a>
                </li>
                <li class="nav-item">
                    @role('Admin')
                    <a class="nav-link" href="{{ route('feedbacks.index') }}">
                    @endrole
                    @hasanyrole('Student|Teacher')
                    <a class="nav-link" href="{{ route('feedbacks.create') }}">
                    @endhasanyrole
                        <i class="ni ni-support-16 text-blue"></i>{{ __('Feedback') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>