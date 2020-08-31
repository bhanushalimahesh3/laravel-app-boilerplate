<?php

return [

    /*
        set path for Transformer files. By default it will be created in "app/MB" folder where MB is configurable folder where you want to create your transformer files. Replace MB with your folder name. 

        Artisan command: php artisan boilerplate-package:transformer-create
    */
    'transformer' => [
                        'path' => 'MB'
    ],


    /*
        set path for helper files. By default it will be created in "app/MB" folder where MB is configurable folder where you want to create your helper files. Replace MB with your folder name

        Artisan command: php artisan boilerplate-package:helper-create
    */
    'helper' => [
                    'path' => 'MB'
    ],


    /*
        When creating helper class ResponseTrait file will be dumped in Traits folder. It will be in "app/Traits" folder, where Traits folder is configurable.

        This trait will be created when you fire 
        Artisan command: php artisan boilerplate-package:form-request-create
    */
    'trait' => [
                    'path' => 'Traits'
    ],


    /*
      Configure where you want to dump your layouts and partials files. With default settings in "resources/views/layouts" folder, layouts files will be dumped.
      
      Similarly partials files will dumped in "resources/views/partials" folder
    */    
    'view' => [
                    'layouts' => 'layouts', 
                    'partials' => 'partials', 
    ]
    
];