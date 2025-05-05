<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;

use Illuminate\Support\Facades\Hash;
use App\Models\User;


use Illuminate\Support\Facades\Log;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {

        // Override LoginResponse to custom re-direct after login
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {

            public function toResponse($request)
            {
            // After successful log-in, redirect user to dashboard according to role/privilege
               $role = $request->user()->role;
               
               Log::info("User logged as " . $request->user() . "; request to /dashboard/$role");
               // make call to route in web.php
               return redirect("/dashboard/$role");

            }
        });

        

    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Allows user to login with username or email instead of 
        // default email only
        Fortify::authenticateUsing(function (Request $request) {

            $user = User::where('email', $request->identity)
                    ->orWhere('name', $request->identity)->first();
     
            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

   }
}
