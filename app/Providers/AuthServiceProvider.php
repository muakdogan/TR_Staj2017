<?php

namespace App\Providers;
use App\Firma;
use App\Ilan;
use App\Policies\FirmaPolicy;
use App\Policies\IlanPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

        'App\Firma'=>'App\Policies\FirmaPolicy',
        'App\Ilan'=>'App\Policies\IlanPolicy',

    ];


    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);


        //
    }
}
