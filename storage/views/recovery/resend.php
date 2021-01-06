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
 * @var UrlGeneratorInterface $urlGenerator
 * @var Translator $translator
 * @var UserParameter $userParameter
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Resend confirmation message'));

/** @psalm-suppress InvalidScope */
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
                    ->action($urlGenerator->generate('resend'))
                    ->options(['csrf' => $csrf, 'id' => 'form-recovery-resend'])
                    ->begin() ?>

                    <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= Html::submitButton(
                        Html::encode($translator->translate('Continue')),
                        [
                            'class' => 'button is-block is-info is-fullwidth',
                            'id' => 'resend-button',
                            'tabindex' => ++$tab,
                        ]
                    ) ?>

                <?= Form::end(); ?>
            </div>
        </div>

        <footer class="card-footer is-justify-content-center">
            <hr class="mt-1"/>

            <?php if ($repositorySetting->isRegister()) : ?>
                <?php $items[] = Html::a(
                    Html::encode($translator->translate("Don't have an account - Sign up!")),
                    $urlGenerator->generate('register'),
                    ['tabindex' => ++$tab],
                ) ?>
            <?php endif ?>

            <?php $items[] = Html::a(
                Html::encode($translator->translate('Already registered - Sign in!')),
                $urlGenerator->generate('login'),
                ['tabindex' => ++$tab],
            ) ?>

            <?= Html::ul($items, ['encode' => false]) ?>

            <hr class="pb-3"/>
        </footer>
    </div>
</div>
