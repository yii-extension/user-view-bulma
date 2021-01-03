<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\Asset;

use Yii\Extension\Fontawesome\Dev\Css\NpmAllAsset;
use Yiisoft\Assets\AssetBundle;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaHelpersAsset;

final class UserAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@user-view-css';

    public array $css = [
        'user-view-bulma.css',
    ];

    public array $depends = [
        BulmaAsset::class,
        BulmaHelpersAsset::class,
        NpmAllAsset::class,
    ];
}
