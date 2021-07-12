<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\Simple\Model\ModelInterface;
use Yii\Extension\User\Settings\ModuleSettings;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\Li;
use Yiisoft\Html\Tag\Ul;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

/**
 * @var string|null $csrf
 * @var Field $field
 * @var ModelInterface $model
 * @var ModuleSettings $moduleSettings
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Log in', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$csrf = $csrf ?? '';
$items = [];
$tab = 0;
?>

<div class="column is-4 is-offset-4">
    <div class="card">
        <header class="card-header">
            <h1 class="card-header-title has-text-black has-text-centered is-justify-content-center is-size-4 title">
                <?= $title ?>
            </h1>
        </header>

        <div class="card-content">
            <div class="content has-text-left">
                <?= Form::widget()
                    ->action($urlGenerator->generate('login'))
                    ->csrf($csrf)
                    ->id('form-auth-login')
                    ->begin() ?>

                    <?= $field->config($model, 'login')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= $field->config($model, 'password')->passwordInput(['tabindex' => ++$tab]) ?>

                    <hr class="mt-1"/>

                    <?= Button::tag()
                        ->attributes(['tabindex' => ++$tab])
                        ->class('button is-block is-info is-fullwidth')
                        ->content($translator->translate('Log in', [], 'user-view'))
                        ->id('login-button')
                        ->type('submit') ?>
                <?= Form::end() ?>
            </div>
        </div>

        <footer class="card-footer has-text-centered is-justify-content-center ">
            <hr class="mt-1"/>

            <?php if ($moduleSettings->isPasswordRecovery()) : ?>
                <?php $items[] = Li::tag()
                    ->class('border-0 list-group-item text-center')
                    ->content(
                        A::tag()
                            ->attributes(['class' => 'has-text-link', 'tabindex' => ++$tab])
                            ->content($translator->translate('Forgot password', [], 'user-view'))
                            ->url($urlGenerator->generate('request'))
                            ->render()
                    )
                    ->encode(false)
                ?>
            <?php endif ?>

            <?php if ($moduleSettings->isRegister()) : ?>
                <?php $items[] = Li::tag()
                    ->class('border-0 list-group-item text-center')
                    ->content(
                        A::tag()
                            ->attributes(['class' => 'has-text-link', 'tabindex' => ++$tab])
                            ->content($translator->translate('Don\'t have an account - Sign up!', [], 'user-view'))
                            ->url($urlGenerator->generate('register'))
                            ->render()
                    )
                    ->encode(false)
                ?>
            <?php endif ?>

            <?php if ($moduleSettings->isConfirmation() === true) : ?>
                <?php $items[] = Li::tag()
                    ->class('border-0 list-group-item text-center')
                    ->content(
                        A::tag()
                            ->attributes(['class' => 'has-text-link', 'tabindex' => ++$tab])
                            ->content($translator->translate('Didn\'t receive confirmation message', [], 'user-view'))
                            ->url($urlGenerator->generate('resend'))
                            ->render()
                    )
                    ->encode(false)
                ?>
            <?php endif ?>

            <?= Ul::tag()->items(...$items) ?>

            <hr class="pb-3"/>
        </footer>
    </div>
</div>
