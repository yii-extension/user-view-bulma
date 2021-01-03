<?php

declare(strict_types=1);

use Yiisoft\Form\FormModelInterface;
use Yii\Extension\User\View\Parameter\UserParameter;
use Yiisoft\Assets\AssetManager;
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
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var UserParameter $userParameter
 * @var WebView $this
 *
 * @psalm-suppress InvalidScope
 */

$this->setTitle('Recover your password.');

$assetManager->register(
    $userParameter->getAssetClass(),
);
?>

<h1 class="title has-text-black">
    <?= $translator->translate('Recover your password') ?>
</h1>

<hr class="mb-2"/>

<div class="column is-4 is-offset-4">
    <?= Form::widget()
        ->action($urlGenerator->generate('request'))
        ->options(
            [
                'id' => 'form-recovery-request',
                'class' => 'forms-recovery-request bg-white shadow-md rounded px-8 pb-8',
                'csrf' => $csrf
            ]
        )
        ->begin() ?>

        <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => '1']) ?>

        <?= Html::submitButton(
            $translator->translate('Continue'),
            [
                'class' => 'button is-block is-info is-fullwidth',
                'name' => 'request-button',
                'tabindex' => '2'
            ]
        ) ?>

    <?php Form::end() ?>

    <hr class="mt-1"/>

    <div class="text-center">
        <?= Html::a(
            $translator->translate('Already registered - Sign in!'),
            $urlGenerator->generate('login'),
            ['tabindex' => '3']
        ) ?>
    </div>
</div>
