<?php

namespace Modules\Builder\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Builder\GustavoPackageBuilder;
use Modules\Builder\Console\Commands\TestCommand;

class GustavoPackageBuilderServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TestCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->app->singleton('builder', function ($app) {
            return new GustavoPackageBuilder();
        });
    }
}
