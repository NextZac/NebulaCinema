<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use SocialiteProviders\Manager\SocialiteWasCalled;
use Inertia\Inertia;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
        JsonResource::withoutWrapping();
        Carbon::setLocale(app()->getLocale());

        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
        $event->extendSocialite('harid', \SocialiteProviders\HarID\Provider::class);
        });
    }
}
