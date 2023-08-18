<?php

namespace App\Providers;

use App\Services\Gateways\GatewayInterfaceService;
use App\Services\Gateways\IdPayGatewayService;
use App\Services\Gateways\ZarinpalGatewayService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /* If other gateway added to project you should add their name and correspond class name here!
         * For example add this line to match part:
         * 'toman' => new TomanGatewayService(),
         */
        $this->app->bind(GatewayInterfaceService::class, function () {
            return match (config('payment.ipg')) {
                'idpay' => new IdPayGatewayService(),
                default => new ZarinpalGatewayService(),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
