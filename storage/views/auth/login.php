<?php

declare(strict_types=1);

use Yii\Extension\User\Settings\RepositorySetting;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

/**
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var RepositorySetting $repositorySetting
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 *
 * @psalm-suppress InvalidScope
 */

$this->setTitle('Login');
?>

<h1 class="title has-text-black">
    <?= $translator->translate('Login') ?>
</h1>

<hr class="mb-2"/>

<div class="column is-4 is-offset-4">
    <div class="box">
        <?= Form::widget()
            ->action($urlGenerator->generate('login'))
            ->options(
                [
                    'id' => 'form-auth-login',
                    'class' => 'forms-auth-login bg-white shadow-md rounded px-8 pb-8',
                    'csrf' => $csrf,
                ]
            )
            ->begin() ?>

            <?= $field->config($data, 'login')->textInput(['autofocus' => true, 'tabindex' => '1']) ?>

            <?= $field->config($data, 'password')->passwordInput(['tabindex' => '2']) ?>

            <?= Html::submitButton(
                $translator->translate('Login') . ' ' .
                html::tag('i', '', ['class' => 'fas fa-sign-in-alt', 'aria-hidden' => 'true']),
                [
                    'class' => 'button is-block is-info is-fullwidth',
                    'id' => 'login-button',
                    'tabindex' => '3'
                ]
            ) ?>

        <?= Form::end() ?>

        <hr class="mt-1"/>

        <?php if ($repositorySetting->isPasswordRecovery()) : ?>
            <div class="text-center">
                <?= Html::a(
                    $translator->translate('Forgot password'),
                    $urlGenerator->generate('request'),
                    ['tabindex' => '4'],
                ) ?>
            </div>
        <?php endif ?>

        <?php if ($repositorySetting->isRegister()) : ?>
            <div class="text-center">
                <?= Html::a(
                    $translator->translate('Don\'t have an account - Sign up!'),
                    $urlGenerator->generate('register'),
                    ['tabindex' => '5'],
                ) ?>
            </div>
        <?php endif ?>

        <?php if ($repositorySetting->isConfirmation()) : ?>
            <div class="text-center">
                <?= Html::a(
                    $translator->translate("Didn't receive confirmation message"),
                    $urlGenerator->generate('resend'),
                    ['tabindex' => '6'],
                ) ?>
            </div>
        <?php endif ?>
    </div>
</div>
