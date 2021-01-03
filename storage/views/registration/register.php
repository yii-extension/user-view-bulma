<?php

declare(strict_types=1);

use Yii\Extension\User\Settings\RepositorySetting;
use Yii\Extension\User\View\Parameter\UserParameter;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

/**
 * @var AssetManager $assetManager
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var RepositorySetting $repositorySetting
 * @var UrlGeneratorInterface $urlGenerator
 * @var Translator $translator
 * @var UserParameter $userParameter
 * @var WebView $this
 *
 * @psalm-suppress InvalidScope
 */

$this->setTitle('Register');

$assetManager->register(
    $userParameter->getAssetClass(),
);
?>

<h1 class="title has-text-black">
    <?= $translator->translate('Register') . '.' ?>
</h1>

<hr class="mb-2"/>

<div class="column is-4 is-offset-4">
    <?= Form::widget()
        ->action($urlGenerator->generate('register'))
        ->options(
            [
                'id' => 'form-registration-register',
                'class' => 'forms-registration-register bg-white shadow-md rounded px-8 pb-8',
                'csrf' => $csrf,
            ]
        )
        ->begin() ?>

        <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => '1']) ?>

        <?= $field->config($data, 'username')->textInput(['tabindex' => '2']) ?>

        <?php if ($repositorySetting->isGeneratingPassword() === false) : ?>
            <?= $field->config($data, 'password')->passwordInput(['tabindex' => '3']) ?>
        <?php endif ?>

        <?= Html::submitButton(
            $translator->translate('Register'),
            [
                'class' => 'button is-block is-info is-fullwidth', 'id' => 'register-button', 'tabindex' => '4'
            ]
        ) ?>

        <hr class="mt-1"/>

        <div class="text-center">
            <?= Html::a(
                $translator->translate('Already registered - Sign in!'),
                $urlGenerator->generate('login'),
                ['tabindex' => '5']
            ) ?>
        </div>

    <?php Form::end() ?>
</div>
