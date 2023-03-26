<?php

namespace Vhits\Laravelmoduleapi;

use Illuminate\Support\ServiceProvider;
use Vhits\Laravelmoduleapi\Console\ModuleGenerateCustom;
use Vhits\Laravelmoduleapi\Console\MakeServiceCommand;
use Vhits\Laravelmoduleapi\Console\MakeRepositoryCommand;
use Vhits\Laravelmoduleapi\Console\MakeControllerCommand;
use Vhits\Laravelmoduleapi\Console\MakeModelCommand;
use Vhits\Laravelmoduleapi\Console\MakeMigrationCommand;

class ModuleMakeProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Services/' => base_path('app/Services/'),
        ], 'Services');
        $this->publishes([
            __DIR__ . '/Repositories/' => base_path('app/Repositories/'),
        ], 'Repositories');
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                ModuleGenerateCustom::class,
                MakeServiceCommand::class,
                MakeControllerCommand::class,
                MakeRepositoryCommand::class,
                MakeModelCommand::class,
                MakeMigrationCommand::class,
            ]);
        }
    }
}
