<?php

namespace BhanushaliMahesh\BoilerplatePackage;

use Exception;

class ViewManager
{

    protected $name;

    protected $layout;

    protected $type;

    protected $stubs;


    public function __construct()
    {
        $this->stubs = config('template_stubs');
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setLayout($layout = '')
    {
        $this->layout = $layout;

        return $this;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        if (!in_array($type, ['blade', 'layout'])) {
            throw new Exception('unknown type ' . $type);
        }

        $this->type = $type;

        return $this;
    }

    public function convertStubs()
    {
        
        if($this->type === 'layout') {
            $this->layouts();
            $this->partials();
        }else{
            $this->blade();
        }

        return true;
    }

    private function layouts()
    {
        $authStub = __DIR__ . '/Console/stubs/view/layouts/auth.blade.php.stub';
        $guestStub = __DIR__ . '/Console/stubs/view/layouts/guest.blade.php.stub';

        // check auth/guest layout stub file exists
        if ((file_exists($authStub) === false) || 
            (file_exists($guestStub) === false)) {
            throw new Exception ('Guest or Auth Layout stub file missing');
        }

        // check if guest or layour already exported
        $layoutFolder = resource_path('views').'/'.config('boilerplate_package.view.layouts');
        
        if(is_dir($layoutFolder) === false) {
            mkdir($layoutFolder, 0755, true);
        }

        $auth = $layoutFolder.'/auth.blade.php';
        $guest = $layoutFolder.'/guest.blade.php';

        // check if auth layout is already exported
        if(file_exists($auth) || file_exists($guest))
            throw new Exception ('Auth or Guest Layout file already present, delete it first');

        // replace header string
        $authContent = file_get_contents($authStub);    
        $authContent = str_replace('partialHeader', 
                                "'".str_replace('/', '.', config('boilerplate_package.view.partials').'.header')."'", 
                                $authContent);
        $authContent = str_replace('partialJs', 
                                "'".str_replace('/', '.', config('boilerplate_package.view.partials').'.js')."'", 
                                $authContent);                        
        
        $guestContent = file_get_contents($guestStub);
        $guestContent = str_replace('partialHeader', 
                                "'".str_replace('/', '.', config('boilerplate_package.view.partials').'.header')."'", 
                                $guestContent);
        $guestContent = str_replace('partialJs', 
                                "'".str_replace('/', '.', config('boilerplate_package.view.partials').'.js')."'", 
                                $guestContent); 

        if (!file_put_contents($auth, $authContent)) {
            throw new Exception('Could not write to ' . $auth);
        }
        
        if (!file_put_contents($guest, $guestContent)) {
            throw new Exception('Could not write to ' . $guest);
        }

        return true;
    }

    private function partials()
    {
        $jsStub = __DIR__ . '/Console/stubs/view/partials/js.blade.php.stub';
        $cssStub = __DIR__ . '/Console/stubs/view/partials/css.blade.php.stub';
        $headerStub = __DIR__ . '/Console/stubs/view/partials/header.blade.php.stub';
        
        // check auth/guest layout stub file exists
        if ((file_exists($jsStub) === false) || 
            (file_exists($cssStub) === false) ||
            (file_exists($headerStub) === false)) {
            throw new Exception ('Css or Js or header partial stub file missing');
        }

        // check if guest or layour already exported
        $partialFolder = resource_path('views').'/'.config('boilerplate_package.view.partials');
        if(is_dir($partialFolder) === false) {
            mkdir($partialFolder, 0755, true);
        }

        $css = $partialFolder.'/css.blade.php';
        $js = $partialFolder.'/js.blade.php';
        $header = $partialFolder.'/header.blade.php';

        // check if auth layout is already exported
        if(file_exists($css) || file_exists($js) || file_exists($header))
            throw new Exception ('Auth or Guest Layout file already present, delete it first');

        $jsContent = file_get_contents($jsStub);
        $cssContent = file_get_contents($cssStub);
        $headerContent = file_get_contents($headerStub);
        $headerContent = str_replace('partialCss', 
                                    "'".str_replace('/', '.', config('boilerplate_package.view.partials').'.css')."'", 
                                    $headerContent); 

        if (!file_put_contents($css, $cssContent)) {
            throw new Exception('Could not write to ' . $css);
        }
        
        if (!file_put_contents($js, $jsContent)) {
            throw new Exception('Could not write to ' . $js);
        }

        if (!file_put_contents($header, $headerContent)) {
            throw new Exception('Could not write to ' . $header);
        }        
        
        return true;
    }

    private function blade()
    {
        if(empty($this->type))
            throw new Exception ('Type argument missing');

        if(empty($this->name))
            throw new Exception ('Blade file name argument missing'); 
        
        if(empty($this->layout))
            throw new Exception ('Layout to extend argument missing');   

        $bladeStub = __DIR__ . '/Console/stubs/view/blade.blade.php.stub';
        
        // check auth/guest layout stub file exists
        if ((file_exists($bladeStub) === false)) {
            throw new Exception ('Blade stub file missing');
        }

        
        $bladeFilePath = resource_path('views').'/'.str_replace(".", "/", $this->name).'.blade.php';
        $bladeParentFolder = rtrim($bladeFilePath, basename($bladeFilePath));

        // check if guest or layour already exported
        if(is_dir($bladeParentFolder) === false) {
            mkdir($bladeParentFolder, 0755, true);
        }

        // check if auth layout is already exported
        if(file_exists($bladeFilePath))
            throw new Exception ($bladeFilePath.' file already present, delete it first');

        $bladeContent = file_get_contents($bladeStub);
        $bladeContent = str_replace('layout', 
                                    "'".$this->layout."'", 
                                    $bladeContent); 

        if (!file_put_contents($bladeFilePath, $bladeContent)) {
            throw new Exception('Could not write to ' . $bladeFilePath);
        }
        
        return true;
    }

}