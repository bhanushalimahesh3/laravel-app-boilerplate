<?php

namespace BhanushaliMahesh\BoilerplatePackage\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;

class HelperCommand extends GeneratorCommand
{
    protected $name = 'boilerplate-package:helper-create';

    protected $description = 'Create a new helper class';

    protected $type = 'Helper';

    const  EXTEND_CLASS_PLACEHOLDER = 'DummyExtendClassNamespace';
    const  STUB_FOLDER = '/stubs/helper/';

    protected function getStub()
    {
        return __DIR__ . self::STUB_FOLDER . 'helper_class.php.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . "\\" . config('boilerplate_package.helper.path');
    }

    public function handle()
    {
        parent::handle();

        $this->replaceExtendClassPlaceholder();

        $this->createResponseTrait();

        $this->createHelperBase();
    }

    protected function replaceExtendClassPlaceholder()
    {
        // get extend class full namespace
        $usePlaceholder = $this->qualifyClass('BaseHelper');
        
        // get class namespace where we want to update
        $class = $this->qualifyClass($this->getNameInput());

        // get the destination path, based on the default namespace
        $path = $this->getPath($class);
        
        $content = file_get_contents($path);

        $content = str_replace(self::EXTEND_CLASS_PLACEHOLDER, $usePlaceholder, $content);
       
        // Update the file content with additional data (regular expressions)

        file_put_contents($path, $content);

        
    }

    private function createHelperBase()
    {
        $helperBaseClass = $this->qualifyClass('BaseHelper'); 

        $helperBaseClassPath = $this->getPath($helperBaseClass); 

        $helperBaseClassNamespace = $this->getNamespace($helperBaseClass);

        $traitNamespace = $this->getTraitNamespace();
    
        // make sure we're starting from a clean state
        if (!File::exists($helperBaseClassPath)) {
            $content = file_get_contents(__DIR__ . self::STUB_FOLDER . 'base.php.stub');
            $content = str_replace('DummyNamespace', $helperBaseClassNamespace, $content);
            $content = str_replace('DummyTraitNamespace', $traitNamespace, $content);
            file_put_contents($helperBaseClassPath, $content);        
            
        }
    }

    private function createResponseTrait()
    {
        $traitName = $this->getTraitNamespace();
        $traitPath = $this->getPath($traitName); 
        $traitRootNamespace = $this->getNamespace($traitName);

            // make sure we're starting from a clean state
        if (!File::exists($traitPath)) {

            $this->makeDirectory($traitPath);

            $content = file_get_contents(__DIR__ . '/stubs/trait/response.php.stub');
            $content = str_replace('DummyNamespace', $traitRootNamespace, $content);
            file_put_contents($traitPath, $content);        
            
        }

    }

    private function getTraitNamespace()
    {
        return $this->rootNamespace(). config('boilerplate_package.trait.path') . '\ResponseTrait';
    }
}