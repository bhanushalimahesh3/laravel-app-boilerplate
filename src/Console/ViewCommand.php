<?php

namespace BhanushaliMahesh\BoilerplatePackage\Console;

use Exception;
use Illuminate\Console\Command;
use BhanushaliMahesh\BoilerplatePackage\ViewManager;

class ViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boilerplate-package:view
        { type : blade or layout? }
        { name? : blade name }
        { layout? : layout name }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create blade view file or layout file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $manager = new ViewManager();

        try {
            $this->info('Creating a view file');

            $path = $manager
                ->setType($this->argument('type'))
                ->setName($this->argument('name') ?? '')
                ->setLayout($this->argument('layout') ?? '')
                ->convertStubs();

            $this->info('Creating a view file completed!!!');
            
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}