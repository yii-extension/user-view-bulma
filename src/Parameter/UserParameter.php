<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\Parameter;

use Yii\Extension\User\View\Asset\UserAsset;

final class UserParameter
{
    private array $assets = [];
    private string $assetClass;
    private bool $registerAsset;

    public function __construct(string $assetClass, bool $registerAsset)
    {
        $this->assetClass = $assetClass;
        $this->registerAsset = $registerAsset;
    }

    public function getAssetClass(): array
    {
        if ($this->registerAsset) {
            $this->assets[] = $this->assetClass;
        }

        return $this->assets;
    }
}
