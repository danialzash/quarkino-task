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
        $this->app->bind(GatewayInterfaceService::class, function () {
            $paymentService = config('payment.IPG_service');
            if ($paymentService == 'pasargad') {
                return new ZarinpalGatewayService();
            } else {
                return new IdPayGatewayService();
            }
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
