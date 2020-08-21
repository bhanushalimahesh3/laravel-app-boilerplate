<?php

//
return [

    // considering app as root. eg. Echallan. Then folder structure will be in app\Echallan\Transformers\Transformer.php
    'transformer' => [
                        'path' => 'Echallan'
    ],

    'helper' => [
                    'path' => 'Echallan'
    ],

    'trait' => [
                    'path' => 'Traits'
    ],

    'view' => [
                    'layouts' => 'admin/layouts', // i.e rsources/view/layouts
                    'partials' => 'admin/partials', // i.e respurces/views/partials
    ]
    
];