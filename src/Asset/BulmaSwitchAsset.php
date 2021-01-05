<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\Asset;

use Yiisoft\Assets\AssetBundle;

final class BulmaSwitchAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@npm/bulma-switch/dist/css';

    public array $css = [
        'bulma-switch.min.css'
    ];
}
