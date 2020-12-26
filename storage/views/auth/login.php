<?php

declare(strict_types=1);

use Yii\Extension\Fontawesome\Dev\Css\NpmAllAsset;
use Yii\Extension\User\View\LoginAsset;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Translator\Message\Php\MessageSource;
use Yiisoft\View\WebView;

/**
 * @var Aliases Aliases
 * @var string $action
 * @var AssetManager $assetManager
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var bool $isPasswordRecovery
 * @var string $linkResend
 * @var Locale $locale
 * @var WebView $this
 */

$this->setTitle('Login');

$assetManager->register([
    NpmAllAsset::class,
    LoginAsset::class,
]);

$translator = new MessageSource($aliases->get('@user-view-language'));

?>

<p class="title has-text-black">
    <?= $translator->getMessage('Sing in', 'user', $locale->language()) ?>
</p>

<p class="subtitle has-text-black">
    <?= $translator->getMessage('Please fill out the following', 'user', $locale->language()) ?>
</p>

<hr class='mb-2'/>

<div class = 'column is-4 is-offset-4'>

    <div class = 'box'>

        <div class = 'buttons justify-center has-margin-bottom-10'>

            <button class = 'button is-medium is-black'>
                <span class = 'icon is-medium'>
                    <i class = 'fab fa-github fa-2x fa-inverse'></i>
                </span>
            </button>

            <button class = 'button is-medium is-black'>
                <span class = 'icon is-medium'>
                    <i class = 'fab fa-yandex fa-2x fa-inverse'></i>
                </span>
            </button>

            <button class = 'button is-medium is-black'>
            <span class = 'icon is-medium'>
                    <i class = 'fab fa-google fa-2x fa-inverse'></i>
                </span>
            </button>

        </div>

        <?= Form::widget()
            ->action($action)
            ->options(
                [
                    'id' => 'form-security-login',
                    'csrf' => $csrf
                ]
            )
            ->begin() ?>

            <?= $field->config($data, 'login')
                ->textInput(
                    [
                        'placeholder' => $translator->getMessage('Username', 'user', $locale->language()),
                        'tabindex' => '1'
                    ]
                ) ?>

            <?= $field->config($data, 'password')
                ->passwordInput(
                    [
                        'placeholder' => $translator->getMessage('Password', 'user', $locale->language()),
                        'tabindex' => '2'
                    ]
                ) ?>

            <?= Html::submitButton(
                $translator->getMessage('Login', 'user', $locale->language()) . ' ' .
                html::tag('i', '', ['class' => 'fas fa-sign-in-alt', 'aria-hidden' => 'true']),
                [
                    'class' => 'button is-block is-info is-fullwidth',
                    'id' => 'login-button',
                    'tabindex' => '3'
                ]
            ) ?>

        <?= Form::end() ?>

        <?php if ($isPasswordRecovery === true) : ?>
            <p class = 'has-text-grey has-margin-top-10'>
                <?= Html::a(
                    $translator->getMessage('Forgot Password', 'user', $locale->language()),
                    /*$url->generate('recovery/request'), */
                    ['tabindex' => '4'],
                ) ?>
            </p>
        <?php endif ?>

        <p class = 'has-text-grey'>
            <?= Html::a(
                $translator->getMessage("Didn't receive confirmation message", 'user', $locale->language()),
                $linkResend,
                ['tabindex' => '5'],
            ) ?>
        </p>

    </div>

</div>
