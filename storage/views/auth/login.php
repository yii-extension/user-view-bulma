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

if ($repositorySetting->isPasswordRecovery()) {
    $items[] = Html::a(
        Html::encode($translator->translate('Forgot password')),
        $urlGenerator->generate('request'),
        ['tabindex' => '4'],
    );
}

if ($repositorySetting->isRegister()) {
    $items[] = Html::a(
        Html::encode($translator->translate('Don\'t have an account - Sign up!')),
        $urlGenerator->generate('register'),
        ['tabindex' => '5'],
    );
}

if ($repositorySetting->isConfirmation()) {
    $items[] = Html::a(
        Html::encode($translator->translate("Didn't receive confirmation message")),
        $urlGenerator->generate('resend'),
        ['tabindex' => '6'],
    );
}
?>

<h1 class="title has-text-black">
    <?= $title ?>
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
                Html::encode($translator->translate('Login')),
                [
                    'class' => 'button is-block is-info is-fullwidth',
                    'id' => 'login-button',
                    'tabindex' => '3'
                ]
            ) ?>

        <?= Form::end() ?>

        <hr class="mt-1"/>

        <?= Html::ul(
            $items,
            [
                'encode' => false,
                'itemOptions' => ['class' => 'text-center'],
            ]
        ); ?>
    </div>
</div>
