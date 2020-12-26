<?php

declare(strict_types=1);

namespace Yii\Extension\User\View;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;

final class ResendAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@user-view-css';

    public array $css = [
        'resend.css',
    ];

    public array $depends = [
        BulmaAsset::class
    ];
}
