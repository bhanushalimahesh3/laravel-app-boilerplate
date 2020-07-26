<?php

namespace BhanushaliMahesh\TransformerPackage;

use Illuminate\Support\ServiceProvider;
use BhanushaliMahesh\TransformerPackage\Console\InstallTransformerPackage;
use BhanushaliMahesh\TransformerPackage\Transformer;
use BhanushaliMahesh\TransformerPackage\Console\TransformerCommand;


class TransformerServiceProvider extends ServiceProvider
{
  public function register()
  {
/*     $this->app->bind('BhanushaliMahesh\TransformerPackage\Transformer', function(){
      return new Transformer;
    }); */

    //\Log::info('called register');
    $this->mergeConfigFrom(__DIR__.'/config/transformer_package.php', 'transformer_package');
  }

  public function boot()
  {
    //\Log::info('called boot');
    if ($this->app->runningInConsole()) {

      $this->commands([
        InstallTransformerPackage::class,
        TransformerCommand::class
      ]);

      
      
      $this->publishes([
        __DIR__.'/config/transformer_package.php' => config_path('transformer_package.php')
      ], 'config');


    }

  }
}