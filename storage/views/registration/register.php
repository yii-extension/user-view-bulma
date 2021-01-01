<?php

declare(strict_types=1);

use Yii\Extension\User\Settings\RepositorySetting;
use Yii\Extension\User\View\Asset\Register;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;

$this->setTitle('Register');

 /**
  * @var string $action
  * @var AssetManager $assetManager
  * @var string|null $csrf
  * @var FormModelInterface $data
  * @var Field $field
  * @var RepositorySetting $setting
  * @var UrlGeneratorInterface $urlGenerator
  * @var Translator $translator
  */

$assetManager->register([
    Register::class
]);

?>

<h1 class="title has-text-black">
    <?= $translator->translate('Register') . '.' ?>
</h1>

<hr class='mb-2'/>

<div class = 'column is-4 is-offset-4'>

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

        <?= $field->config($data, 'email')
            ->textInput(
                [
                    'autofocus' => true,
                    'placeholder' => $translator->translate('Email'),
                    'tabindex' => '1'
                ]
            ) ?>

        <?= $field->config($data, 'username')
            ->textInput(
                [
                    'placeholder' => $translator->translate('Username'),
                    'tabindex' => '2'
                ]
            ) ?>

        <?php if ($setting->isGeneratingPassword() === false) : ?>
            <?= $field->config($data, 'password')
                ->passwordInput(
                    [
                        'placeholder' => $translator->translate('Password'),
                        'tabindex' => '3'
                    ]
                ) ?>
        <?php endif ?>

        <div class = 'flex items-center justify-between'>
            <?= Html::submitButton(
                $translator->translate('Register'),
                [
                    'class' => 'button is-block is-info is-fullwidth', 'id' => 'register-button', 'tabindex' => '4'
                ]
            ) ?>

        </div>

        <hr class='mb-2'/>

        <div class = 'text-center pt-3'>
            <?= Html::a(
                $translator->translate('Already registered - Sign in!'),
                $urlGenerator->generate('login'),
                ['tabindex' => '5']
            ) ?>
        </div>

    <?php Form::end() ?>

</div>
