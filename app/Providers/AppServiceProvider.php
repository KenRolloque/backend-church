<?php

namespace App\Providers;

use App\Models\Attendees;
use App\Models\KidsModel;
use App\Models\One2OneModel;
use App\Models\LeaderModel;
use App\Models\VictoryWeekendModel;
use App\Models\ClassesModel;
use App\Models\MinistryModel;
use App\Models\InternModel;
use App\Models\VGModel;

use App\Policies\AttendeesPolicy;
use App\Policies\MinistryPolicy;
use App\Policies\One2OnePolicy;
use App\Policies\LeaderPolicy;
use App\Policies\VictoryWeekendPolicy;
use App\Policies\ClassesPolicy;
use App\Policies\InternPolicy;
use App\Policies\VGPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Gate::policy(Attendees::class, AttendeesPolicy::class);
        Gate::policy(One2OneModel::class, One2OnePolicy::class);
        Gate::policy(LeaderModel::class, LeaderPolicy::class);
        Gate::policy(VictoryWeekendModel::class, VictoryWeekendPolicy::class);
        Gate::policy(ClassesModel::class, ClassesPolicy::class);
        Gate::policy(MinistryModel::class, MinistryPolicy::class);
        Gate::policy(InternModel::class, InternPolicy::class);
        Gate::policy(VGModel::class, VGPolicy::class);
    }
}
