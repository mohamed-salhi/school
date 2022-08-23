<?php

namespace App\Providers;

use App\DesignPatern\PromotionDesginInterface;
use App\DesignPatern\PromotionsDesgin;
use App\DesignPatern\StudentsDesgin;
use App\DesignPatern\StudentsDesginInterface;
use Illuminate\Support\ServiceProvider;

class DesignPatren extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            StudentsDesginInterface::class,
            StudentsDesgin::class
        );
        $this->app->bind(
            PromotionDesginInterface::class,
            PromotionsDesgin::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
