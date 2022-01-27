<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();
        view()->composer([
            'layouts.navbars.sidebar'
        ], function($view) {
            $loggedInUser = auth()->user()->id;
            $groupsjoined = DB::select("SELECT classgroups.groupname,classgroups.id FROM groupmembers JOIN classgroups ON groupmembers.group_id = classgroups.id WHERE groupmembers.user_id = '$loggedInUser'");            
            view()->share('groupsjoined', $groupsjoined);
        });
    }
}
