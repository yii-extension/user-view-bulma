<?php

declare(strict_types=1);

use Yii\Extension\User\View\ResendAsset;
use App\Module\User\Form\FormResend;
use App\Module\User\Repository\ModuleSettingsRepository;
use Yii\Extension\Fontawesome\Dev\Css\NpmAllAsset;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Message\Php\MessageSource;

$this->setTitle('Resend confirmation message');

/**
 * @var string $action
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
    NpmAllAsset::class,
    ResendAsset::class
]);

$translator = new MessageSource($aliases->get('@user-view-language'));

?>

<p class="title has-text-black">
    <?= $translator->getMessage('Resend confirmation message', 'user', $locale->language()) ?>
</p>

<p class="subtitle has-text-black">
    <?= $translator->getMessage('Please fill out the following', 'user', $locale->language()) ?>
</p>

<hr class='mb-2'/>

<div class = 'column is-4 is-offset-4'>

    <?= Form::widget()
        ->action($action)
        ->options(
            [
                'id' => 'form-registration-resend',
                'class' => 'forms-registration-resend bg-white shadow-md rounded px-8 pb-8',
                'csrf' => $csrf
            ]
        )
        ->begin() ?>

        <?= $field->config($data, 'email')
            ->textInput(
                [
                    'placeholder' => $translator->getMessage('email', 'user', $locale->language()),
                    'tabindex' => '1'
                ]
            ) ?>

        <?= Html::submitButton(
            $translator->getMessage('Continue', 'user', $locale->language()),
            [
                'class' => 'button is-block is-info is-fullwidth', 'name' => 'resend-button', 'tabindex' => '2'
            ]
        ) ?>

    <?php Form::end(); ?>

    <hr class='mb-2'/>

    <?php if ($settings->isRegister()) : ?>
        <p class = 'text-center'>
            <?= Html::a(
                $translator->getMessage("Don't have an account - Sign up!", 'user', $locale->language()),
                $urlGenerator->generate('register'),
                ['tabindex' => '3']
            ) ?>
        </p>
    <?php endif ?>

    <p class = 'mt-3 text-center'>
        <?= Html::a(
            $translator->getMessage('Already registered - Sign in!', 'user', $locale->language()),
            $urlGenerator->generate('login'),
            ['tabindex' => '4']
        ) ?>
    </p>

</div>
