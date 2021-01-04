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
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var UserParameter $userParameter
 * @var WebView $this
 *
 * @psalm-suppress InvalidScope
 */

$title = Html::encode($translator->translate('Login'));
$this->setTitle($title);

$assetManager->register(
    $userParameter->getAssetClass(),
);

$items = [];
$tab = 0;
?>

<div class="column is-4 is-offset-4">
    <div class="card">
        <header class="card-header">
            <h1 class="card-header-title has-text-black is-justify-content-center title">
                <?= $title ?>
            </h1>
        </header>

        <div class="card-content">
            <div class="content">
                <?= Form::widget()
                    ->action($urlGenerator->generate('login'))
                    ->options(
                        [
                            'class' => 'forms-auth-login',
                            'csrf' => $csrf,
                            'id' => 'form-auth-login',
                        ]
                    )
                    ->begin() ?>

                    <?= $field->config($data, 'login')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= $field->config($data, 'password')->passwordInput(['tabindex' => ++$tab]) ?>

                    <?= Html::submitButton(
                        Html::encode($translator->translate('Login')),
                        [
                            'class' => 'button is-block is-info is-fullwidth',
                            'id' => 'login-button',
                            'tabindex' => ++$tab,
                        ]
                    ) ?>

                <?= Form::end() ?>
            </div>
        </div>

        <footer class="card-footer is-justify-content-center">
            <hr class="mt-1"/>

            <?php if ($repositorySetting->isPasswordRecovery()) : ?>
                <?php $items[] = Html::a(
                    Html::encode($translator->translate('Forgot password')),
                    $urlGenerator->generate('request'),
                    ['tabindex' => ++$tab],
                ) ?>
            <?php endif ?>

            <?php if ($repositorySetting->isRegister()) : ?>
                <?php $items[] = Html::a(
                    Html::encode($translator->translate('Don\'t have an account - Sign up!')),
                    $urlGenerator->generate('register'),
                    ['tabindex' => ++$tab],
                ) ?>
            <?php endif ?>

            <?php if ($repositorySetting->isConfirmation()) : ?>
                <?php $items[] = Html::a(
                    Html::encode($translator->translate("Didn't receive confirmation message")),
                    $urlGenerator->generate('resend'),
                    ['tabindex' => ++$tab],
                ) ?>
            <?php endif ?>

            <?= Html::ul($items, ['encode' => false]) ?>

            <hr class="pb-3"/>
        </footer>
    </div>
</div>
