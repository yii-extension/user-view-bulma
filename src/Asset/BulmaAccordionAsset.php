<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;

final class BulmaAccordionAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@npm/bulma-accordion/dist';

    public array $css = [
        'css/bulma-accordion.min.css'
    ];

    public array $js = [
        'js/bulma-accordion.min.js'
    ];

    public array $depends = [
        BulmaAsset::class,
    ];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only(
                '**css/bulma-accordion.min.css',
                '**js/bulma-accordion.min.js',
            ),
        ];
    }
}
