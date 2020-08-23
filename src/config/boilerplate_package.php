<?php

return [

    // considering app as root. eg. MB. Then folder structure will be in app\MB\Transformers\Transformer.php
    'transformer' => [
                        'path' => 'MB'
    ],

    'helper' => [
                    'path' => 'MB'
    ],

    'trait' => [
                    'path' => 'Traits'
    ],

    'view' => [
                    'layouts' => 'layouts', // i.e rsources/view/layouts
                    'partials' => 'partials', // i.e respurces/views/partials
    ]
    
];