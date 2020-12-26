<?php

declare(strict_types=1);

use Yii\Extension\Service\ServiceParameter;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Form\Widget\Field;
use Yiisoft\I18n\Locale;
use Yiisoft\Factory\Definitions\Reference;

return [
    'app' => [
        /** config language */
        'language' => 'es-CL',

        /** config widget nav */
        'nav' => [
            /**
            * Example menu config simple link, dropdown menu.
            *[
            *   'label' => 'Home',
            *   'url' => ['site/index']
            *],
            *[
            *   'label' => 'Dropdown',
            *   'items' => [
            *       ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
            *       ['label' => 'Level 2 - Dropdown A', 'url' => '#'],
            *       '<li class="dropdown-divider"></li>',
            *       '<li style="color:black;list-style-type: none">Dropdown Header</li>',
            *       ['label' => 'Level 3 - Dropdown B', 'url' => '#'],
            *       ['label' => 'Level 4 - Dropdown A', 'url' => '#'],
            *   ],
            *],
            */
            'guest' => [
                ['label' => 'Register', 'url' => '/register'],
                ['label' => 'Login', 'url' => '/login'],
            ]
        ]
    ],

    'yii-extension/view-services' => [
        'defaultParameters' => [
            'aliases' => Reference::to(Aliases::class),
            'locale' => Reference::to(Locale::class),
            'serviceParameter' => Reference::to(ServiceParameter::class),
        ],
        'viewParameters' => [
            'field' => Reference::to(Field::class),
        ],
    ],

    'yiisoft/aliases' => [
        'aliases' => [
            '@user-view-css' =>  dirname(__DIR__) . '/storage/css',
            '@user-view-language' => dirname(__DIR__) . '/storage/language',
            '@user-view-mail' =>  dirname(__DIR__) . '/storage/mail',
            '@user-view-views' => dirname(__DIR__) . '/storage/views',
        ]
    ],

    'yiisoft/form' => [
        'fieldConfig' => [
            'errorCssClass()' => ['is-danger'],
            'errorOptions()' => [['class' => 'help is-danger has-text-left mt-0 mb-2']],
            'inputCssClass()' => ['input field mb-1'],
            'labelOptions()' => [['label' => '']],
            'successCssClass()' => ['is-success'],
        ],
    ],

    'yiisoft/mailer' => [
        'composer' => [
            'composerView' => '@user-view-mail',
        ],
    ],

    'yiisoft/view' => [
        'theme' => [
            'pathMap' => [
                '@layout' => '@user-view-views/layout',
            ],
        ],
    ],
];
