<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\Parameter;

use Yii\Extension\User\View\Asset\UserAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaHelpersAsset;

final class UserParameter
{
    private array $assets = [];
    private string $assetClass;
    private bool $registerAsset;
    private bool $registerBulmaAsset;

    public function __construct(
        string $assetClass,
        bool $registerAsset,
        bool $registerBulmaAsset
    ) {
        $this->assetClass = $assetClass;
        $this->registerAsset = $registerAsset;
        $this->registerBulmaAsset = $registerBulmaAsset;
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

        return $this->assets;
    }
}
