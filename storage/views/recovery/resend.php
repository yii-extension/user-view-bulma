<?php

declare(strict_types=1);

use Yii\Extension\User\View\Asset\Resend;
use Yii\Extension\User\Form\FormResend;
use Yii\Extension\User\Repository\RepositorySetting;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Message\Php\MessageSource;

$this->setTitle('Resend confirmation message');

/**
 * @var AssetManager $assetManager
 * @var string|null $csrf
 * @var FormResend $data
 * @var Field $field
 * @var Locale $locale
 * @var RepositorySetting $setting
 * @var UrlGeneratorInterface $urlGenerator
 * @var MessageSource $translator
 */

$assetManager->register([
    Resend::class
]);

?>

<h1 class="title has-text-black">
    <?= $translator->translate('Resend confirmation message') ?>
</h1>

<hr class='mb-2'/>

<div class = 'column is-4 is-offset-4'>

    <?= Form::widget()
        ->action($urlGenerator->generate('resend'))
        ->options(
            [
                'id' => 'form-recovery-resend',
                'class' => 'forms-recovery-resend bg-white shadow-md rounded px-8 pb-8',
                'csrf' => $csrf,
            ]
        )
        ->begin() ?>

        <?= $field->config($data, 'email')
            ->textInput(
                [
                    'autofocus' => true,
                    'placeholder' => $translator->translate('email'),
                    'tabindex' => '1'
                ]
            ) ?>

        <?= Html::submitButton(
            $translator->translate('Continue'),
            [
                'class' => 'button is-block is-info is-fullwidth', 'name' => 'resend-button', 'tabindex' => '2'
            ]
        ) ?>

    <?php Form::end(); ?>

    <hr class='mb-2'/>

    <?php if ($setting->isRegister()) : ?>
        <p class = 'text-center'>
            <?= Html::a(
                $translator->translate("Don't have an account - Sign up!"),
                $urlGenerator->generate('register'),
                ['tabindex' => '3']
            ) ?>
        </p>
    <?php endif ?>

    <p class = 'mt-3 text-center'>
        <?= Html::a(
            $translator->translate('Already registered - Sign in!'),
            $urlGenerator->generate('login'),
            ['tabindex' => '4']
        ) ?>
    </p>

</div>
