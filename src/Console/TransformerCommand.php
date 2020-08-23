<?php
namespace BhanushaliMahesh\BoilerplatePackage\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;

class TransformerCommand extends GeneratorCommand
{

    protected $name = 'boilerplate-package:transformer-create';

    protected $description = 'Create a new transformer class';

    protected $type = 'Transformer';

    const  DEFAULT_FOLDER = 'Transformer';
    const  USE_CLASS_PLACEHOLDER = 'DummyExtend';
    const  STUB_FOLDER = '/stubs/transformers/';
    

    protected function getStub()
    {
        return __DIR__.self::STUB_FOLDER.'transformer.php.stub';
    }


    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace."\\".config('boilerplate_package.transformer.path').'\\'.self::DEFAULT_FOLDER;
    }


    public function handle()
    {
        parent::handle();

        $this->replaceExtendPlaceholder();
    }


    protected function replaceExtendPlaceholder()
    {
        // replace use class.
        $usePlaceholder = $this->qualifyClass(self::DEFAULT_FOLDER);
        
        // Get the fully qualified class name (FQN).
        $class = $this->qualifyClass($this->getNameInput());
       
        // get the destination path, based on the default namespace.
        $path = $this->getPath($class);
        
        $content = file_get_contents($path);

        $content = str_replace('DummyExtend', $usePlaceholder, $content);
       
        // Update the file content with additional data (regular expressions).

        file_put_contents($path, $content);

        $this->createTransformBase();
    }


    private function createTransformBase()
    {
        $transformerBaseClass = $this->qualifyClass(self::DEFAULT_FOLDER);        
        $transformerBaseClassPath = $this->getPath($transformerBaseClass);        
        $transformerBaseClassNamespace = $this->getNamespace($transformerBaseClass);
    
        // make sure we're starting from a clean state.
        if (File::exists($transformerBaseClassPath) === false) {
            $content = file_get_contents(__DIR__.self::STUB_FOLDER.'base.php.stub');
            $content = str_replace('DummyNamespace', $transformerBaseClassNamespace, $content);
            file_put_contents($transformerBaseClassPath, $content);        
            
        }
    } //end


}
