<?php
namespace Julfiker\Jasper;

use Illuminate\Support\ServiceProvider;

/**
 * A service provider to integrate with laravel application
 *
 * @author Julfiker <mail.julfiker@gmail.com>
 * Class JasperReportServiceProvider
 * @package Julfiker\Jasper
 */
class JasperReportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/Route/route.php';

        $this->publishes([
            __DIR__.'/Config' => base_path('config')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Julfiker\Jasper\JasperReportPublisherController');
    }
}
