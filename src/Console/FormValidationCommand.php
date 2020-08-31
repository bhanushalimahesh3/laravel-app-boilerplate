<?php

namespace BhanushaliMahesh\BoilerplatePackage\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;

class FormValidationCommand extends GeneratorCommand
{
    protected $name = 'boilerplate-package:form-request-create';

    protected $description = 'Create a new validation trait file';

    protected $type = 'BaseRequestHandler';

    const  DEFAULT_FOLDER= "Http\Requests";
    const  STUB_FOLDER = "\\stubs\\form_validation\\";
    

    protected function getStub()
    {
        return __DIR__ . self::STUB_FOLDER . 'form_validation_trait.php.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . "\\" . self::DEFAULT_FOLDER;
    }

    public function handle()
    {
        $this->info('Creating trait file');

        parent::handle();

        $this->info('Creating trait file completed!!!');

        $this->createValidationContract();
    }

    private function createValidationContract()
    {
        $this->info('Creating base interface');

        $validationContract = $this->qualifyClass('BaseRequestHandler');        
        $validationContractPath = $this->getPath($validationContract);        
        $validationContractNamespace = $this->getNamespace($validationContract);
        
        // make sure we're starting from a clean state
        if (!File::exists($validationContractPath)) {
            $content = file_get_contents(__DIR__ . self::STUB_FOLDER . 'base.php.stub');
            $content = str_replace('DummyNamespace', $validationContractNamespace, $content);
            file_put_contents($validationContractPath, $content);  
        }

        $this->info('Creating base interface completed!!!');
    }
}