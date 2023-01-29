<?php

namespace App\Providers;

use App\Services\DataApiInterface;
use App\Services\EmailServiceInterface;
use App\Services\JsonPlaceholderDataApi;
use App\Services\MailtrapService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * In case we use a different provider from JsonPlaceholder
         * bind the API class in this interface so you don't have to change
         * the other part of code
         * //IMPORTANT MAKE SURE THAT API CLASS IMPLEMENTS THIS INTERFACE
         *
         */
        $this->app->bind(DataApiInterface::class, function ($app) {
            return new JsonPlaceholderDataApi();
        });

        $this->app->bind(EmailServiceInterface::class, function ($app) {
            return new MailtrapService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
