<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        $pattern = '^[\+]{0,1}380([0-9]{9})$)';
//        $pattern = "/^[6-9][0-9]{9}$/";
        $pattern = "/^\+380[0-9]{9}$/";
        Validator::extend('strong_phone',
            function ($attributes, $value, $parameters, $validator) use ($pattern) {
                return is_string($value) && preg_match($pattern, $value);
            }
        );
    }
}
