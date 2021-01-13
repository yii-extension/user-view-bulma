<?php

declare(strict_types=1);

use Yii\Extension\User\View\Asset\BulmaSwitchAsset;
use Yii\Extension\User\Settings\RepositorySetting;
use Yii\Extension\User\View\Parameter\UserParameter;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

/**
 * @var AssetManager $assetManager
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var RepositorySetting $repositorySetting
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var UserParameter $userParameter
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Log in', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$assets = array_merge([BulmaSwitchAsset::class], $userParameter->getAssetClass());

$assetManager->register($assets);

$items = [];
$tab = 0;
?>

<div class="column is-4 is-offset-4">
    <div class="card">
        <header class="card-header">
            <h1 class="card-header-title has-text-black has-text-centered is-justify-content-center title">
                <?= $title ?>
            </h1>
        </header>

        <div class="card-content">
            <div class="content">
                <?= Form::widget()
                    ->action($urlGenerator->generate('login'))
                    ->options(['csrf' => $csrf, 'id' => 'form-auth-login'])
                    ->begin() ?>

                    <?= $field->config($data, 'login')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= $field->config($data, 'password')->passwordInput(['tabindex' => ++$tab]) ?>

                    <hr class="mt-1"/>

                    <?= $field->config($data, 'remember')
                        ->template("{input}{label}")
                        ->label(
                            true,
                            [
                                'label' => Html::encode($translator->translate('Remember me', [], 'user-view')),
                                'for' => 'switchRegister',
                            ]
                        )
                        ->checkbox(
                            ['class' => 'switch is-info', 'id' => 'switchRegister', 'tabindex' => ++$tab],
                            false
                        ) ?>

                    <hr class="mt-1"/>

                    <?= Html::submitButton(
                        Html::encode($translator->translate('Log in', [], 'user-view')),
                        [
                            'class' => 'button is-block is-info is-fullwidth',
                            'id' => 'login-button',
                            'tabindex' => ++$tab,
                        ]
                    ) ?>

                <?= Form::end() ?>
            </div>
        </div>

        <footer class="card-footer has-text-centered is-justify-content-center ">
            <hr class="mt-1"/>

            <?php if ($repositorySetting->isPasswordRecovery()) : ?>
                <?php $items[] = Html::a(
                    $translator->translate('Forgot password', [], 'user-view'),
                    $urlGenerator->generate('request'),
                    ['tabindex' => ++$tab],
                ) ?>
            <?php endif ?>

            <?php if ($repositorySetting->isRegister()) : ?>
                <?php $items[] = Html::a(
                    Html::encode($translator->translate('Don\'t have an account - Sign up!', [], 'user-view')),
                    $urlGenerator->generate('register'),
                    ['tabindex' => ++$tab],
                ) ?>
            <?php endif ?>

            <?php if ($repositorySetting->isConfirmation()) : ?>
                <?php $items[] = Html::a(
                    Html::encode($translator->translate('Didn\'t receive confirmation message', [], 'user-view')),
                    $urlGenerator->generate('resend'),
                    ['tabindex' => ++$tab],
                ) ?>
            <?php endif ?>

            <?= Html::ul($items, ['encode' => false]) ?>

            <hr class="pb-3"/>
        </footer>
    </div>
</div>
