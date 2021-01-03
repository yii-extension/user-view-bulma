<?php

declare(strict_types=1);

namespace Yii\Extension\User\View\ViewInjection;

use Yii\Extension\User\Settings\RepositorySetting;
use Yii\Extension\User\View\Parameter\UserParameter;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\Widget\Field;
use Yiisoft\I18n\Locale;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\User\User;
use Yiisoft\Yii\View\ContentParametersInjectionInterface;
use Yiisoft\Yii\View\LayoutParametersInjectionInterface;

final class UserViewInjection implements ContentParametersInjectionInterface, LayoutParametersInjectionInterface
{
    private AssetManager $assetManager;
    private Field $field;
    private Locale $locale;
    private RepositorySetting $repositorySetting;
    private Translator $translator;
    private UrlGeneratorInterface $urlGenerator;
    private UrlMatcherInterface $urlMatcher;
    private User $user;
    private UserParameter $userParameter;

    public function __construct(
        AssetManager $assetManager,
        Field $field,
        Locale $locale,
        RepositorySetting $repositorySetting,
        Translator $translator,
        UrlGeneratorInterface $urlGenerator,
        UrlMatcherInterface $urlMatcher,
        User $user,
        UserParameter $userParameter
    ) {
        $this->assetManager = $assetManager;
        $this->field = $field;
        $this->locale = $locale;
        $this->repositorySetting = $repositorySetting;
        $this->translator = $translator;
        $this->urlGenerator = $urlGenerator;
        $this->urlMatcher = $urlMatcher;
        $this->user = $user;
        $this->userParameter = $userParameter;
        $this->registerAsset();
    }

    public function getContentParameters(): array
    {
        return [
            'assetManager' => $this->assetManager,
            'field' => $this->field,
            'repositorySetting' => $this->repositorySetting,
            'translator' => $this->translator,
            'urlGenerator' => $this->urlGenerator,
            'urlMatcher' => $this->urlMatcher,
        ];
    }

    public function getLayoutParameters(): array
    {
        return [
            'assetManager' => $this->assetManager,
            'locale' => $this->locale,
            'translator' => $this->translator,
            'urlGenerator' => $this->urlGenerator,
            'urlMatcher' => $this->urlMatcher,
            'user' => $this->user,
        ];
    }

    private function registerAsset(): void
    {
        if ($this->userParameter->isRegisteredAsset()) {
            $this->assetManager->register(
                $this->userParameter->getAssetClass(),
            );
        }
    }
}
