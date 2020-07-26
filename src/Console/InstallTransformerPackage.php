<?php

namespace BhanushaliMahesh\TransformerPackage\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class InstallTransformerPackage extends Command
{
    protected $hidden = false;

    protected $signature = 'transformer-package:install';

    protected $description = 'Install the TransformerPackage';

    public function handle()
    {

      $this->info('Checking if config file already exist, if yes delete');
        // destination path of the 
      $transformerConfig = config_path('transformer_package.php');
    
      // make sure we're starting from a clean state
      if (File::exists($transformerConfig)) {
        $this->info('Deleting exisitng file....');
          
      }

        $this->info('Installing TransformerPackage...');

        $this->info('Publishing configuration...');




        $this->call('vendor:publish', [
            '--provider' => "BhanushaliMahesh\TransformerPackage\TransformerServiceProvider",
            '--tag' => "config"
        ]);

        $this->info('Installed TransformerPackage');
    }
}