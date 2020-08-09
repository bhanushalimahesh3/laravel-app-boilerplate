<?php

namespace BhanushaliMahesh\TransformerPackage;

use Illuminate\Support\ServiceProvider;
use BhanushaliMahesh\TransformerPackage\Console\InstallTransformerPackage;
use BhanushaliMahesh\TransformerPackage\Console\TransformerCommand;
use BhanushaliMahesh\TransformerPackage\Console\FormValidationCommand;
use BhanushaliMahesh\TransformerPackage\Console\HelperCommand;


class TransformerServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->mergeConfigFrom(__DIR__.'/config/transformer_package.php', 'transformer_package');
  }

  public function boot()
  {
    //\Log::info('called boot');
    if ($this->app->runningInConsole()) {

      $this->commands([
        InstallTransformerPackage::class,
        TransformerCommand::class,
        FormValidationCommand::class,
        HelperCommand::class
      ]);

      
      
      $this->publishes([
        __DIR__.'/config/transformer_package.php' => config_path('transformer_package.php')
      ], 'config');


    }

  }
}