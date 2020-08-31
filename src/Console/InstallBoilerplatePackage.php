<?php

namespace BhanushaliMahesh\BoilerplatePackage\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallBoilerplatePackage extends Command
{
    protected $hidden = false;

    protected $signature = 'boilerplate-package:install';

    protected $description = 'This command will publish configuration file';

    public function handle()
    {

      $this->info('Checking if config file already exist, if yes delete the file');

        // destination path of the 
      $boilerplateConfig = config_path('boilerplate_package.php');
    
      // make sure we're starting from a clean state
      if (File::exists($boilerplateConfig)) {
        $this->info('Deleting exisiting configuration file....');
          
      }

      $this->info('Publishing configuration...');

      $this->call('vendor:publish', [
          '--provider' => "BhanushaliMahesh\BoilerplatePackage\BoilerplateServiceProvider",
          '--tag' => "config"
      ]);

      $this->info('configuration file published');
      $this->info('Check your config folder');
      
    }
}