<?php

namespace BhanushaliMahesh\BoilerplatePackage\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallBoilerplatePackage extends Command
{
    protected $hidden = false;

    protected $signature = 'boilerplate-package:install';

    protected $description = 'Install the Boilerplate Package';

    public function handle()
    {

      $this->info('Checking if config file already exist, if yes delete');
        // destination path of the 
      $boilerplateConfig = config_path('boilerplate_package.php');
    
      // make sure we're starting from a clean state
      if (File::exists($boilerplateConfig)) {
        $this->info('Deleting exisitng file....');
          
      }

      $this->info('Installing BoilerplatePackage...');

      $this->info('Publishing configuration...');


      $this->call('vendor:publish', [
          '--provider' => "BhanushaliMahesh\BoilerplatePackage\BoilerplateServiceProvider",
          '--tag' => "config"
      ]);

      $this->info('Installed BoilerplatePackage');
      
    }
}