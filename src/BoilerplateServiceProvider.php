<?php

namespace BhanushaliMahesh\BoilerplatePackage;

use Illuminate\Support\ServiceProvider;
use BhanushaliMahesh\BoilerplatePackage\Console\InstallBoilerplatePackage;
use BhanushaliMahesh\BoilerplatePackage\Console\TransformerCommand;
use BhanushaliMahesh\BoilerplatePackage\Console\FormValidationCommand;
use BhanushaliMahesh\BoilerplatePackage\Console\HelperCommand;
use BhanushaliMahesh\BoilerplatePackage\Console\ViewCommand;


class BoilerplateServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->mergeConfigFrom(__DIR__.'/config/boilerplate_package.php', 'boilerplate_package');
  }

  public function boot()
  {
    
    // run these command only via CLI
    if ($this->app->runningInConsole()) {

      $this->commands([
        InstallBoilerplatePackage::class,
        TransformerCommand::class,
        FormValidationCommand::class,
        HelperCommand::class,
        ViewCommand::class
      ]);

      
      // publish configuration file
      $this->publishes([
        __DIR__.'/config/boilerplate_package.php' => config_path('boilerplate_package.php')
      ], 'config');


    }

  }
}