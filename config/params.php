<?php

declare(strict_types=1);

use Yii\Extension\User\View\Asset\UserAsset;
use Yii\Extension\User\View\ViewInjection\UserViewInjection;
use Yiisoft\Factory\Definition\Reference;
use Yiisoft\Yii\View\CsrfViewInjection;

return [
    'yii-extension/user-view-bulma' => [
        'assetClass' => UserAsset::class,
        'registerAsset' => true,
    ],

    'yiisoft/aliases' => [
        'aliases' => [
            '@user-view-asset' =>  dirname(__DIR__) . '/storage/asset',
            '@user-view-views' => dirname(__DIR__) . '/storage/views',
        ]
    ],

    'yiisoft/yii-view' => [
        'injections' => [
            Reference::to(CsrfViewInjection::class),
            Reference::to(UserViewInjection::class),
        ],
    ],
];
