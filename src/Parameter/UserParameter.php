<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\Parameter;

use Yii\Extension\Fontawesome\Dev\Css\NpmAllAsset;
use Yii\Extension\User\View\Asset\UserAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaHelpersAsset;

final class UserParameter
{
    private array $assets = [];
    private string $assetClass;
    private bool $registerAsset;
    private bool $registerBulmaAsset;
    private bool $registerFontAwesomeIconsAsset;

    public function __construct(
        string $assetClass,
        bool $registerAsset,
        bool $registerBulmaAsset,
        bool $registerFontAwesomeIconsAsset
    ) {
        $this->assetClass = $assetClass;
        $this->registerAsset = $registerAsset;
        $this->registerBulmaAsset = $registerBulmaAsset;
        $this->registerFontAwesomeIconsAsset = $registerFontAwesomeIconsAsset;
    }

    public function getAssetClass(): array
    {
        if ($this->registerAsset) {
            $this->assets[] = $this->assetClass;
        }

        if ($this->registerBulmaAsset) {
            $this->assets[] = BulmaAsset::class;
            $this->assets[] = BulmaHelpersAsset::class;
        }

        if ($this->registerFontAwesomeIconsAsset) {
            $this->assets[] = NpmAllAsset::class;
        }

        return $this->assets;
    }
}
