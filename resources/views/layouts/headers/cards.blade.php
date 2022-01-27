<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Users Registered</h5>
                                    <span class="h2 font-weight-bold mb-0">
                                        @foreach($totalusers as $key => $data)
                                        {{ $firstValue = reset($data); }}
                                        @endforeach
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="ni ni-world-2"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    @role('Admin')
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Groups Created</h5>
                                    <span class="h2 font-weight-bold mb-0">
                                        @foreach($totalgroups as $key => $data)
                                        {{ $firstValue = reset($data); }}
                                        @endforeach
                                    </span>
                                    @endrole
                                    @hasanyrole('Student|Teacher')
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Groups Joined<br>&nbsp;</h5>
                                    <span class="h2 font-weight-bold mb-0">
                                        @foreach($totalgroupsjoined as $key => $data)
                                        {{ $firstValue = reset($data); }}
                                        @endforeach
                                    </span>
                                    @endhasanyrole
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Online Users<br>&nbsp;</h5>
                                    <span class="h2 font-weight-bold mb-0">
                                        <?php $onlineusers = 0; ?>
                                        @foreach($users as $key => $data)
                                        @if(Cache::has('user-is-online-' . $data->id))
                                        <?php $onlineusers += 1; ?>
                                        @endif
                                        @endforeach
                                        {{ $onlineusers }}
                                    </span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    @role('Admin')
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Feedback<br>&nbsp;</h5>
                                    <span class="h2 font-weight-bold mb-0">
                                        @foreach($totalfeedbacks as $key => $data)
                                        {{ $firstValue = reset($data); }}
                                        @endforeach
                                    </span>
                                    @endrole
                                    @hasanyrole('Teacher|Student')
                                    <h5 class="card-title text-uppercase text-muted mb-0">Time</h5>
                                    <span class="h3 font-weight-bold mb-0">
                                    <div id="time"></div>
                                    </span>
                                    @endhasanyrole
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  function showTime() {
    var date = new Date();

    document.getElementById('time').innerHTML = date.toLocaleString();
  }

  setInterval(showTime, 1000);
</script>