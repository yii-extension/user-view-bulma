<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\Simple\Model\ModelInterface;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

/**
 * @var string $code
 * @var string|null $csrf
 * @var Field $field
 * @var ModelInterface $model
 * @var string $id
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Reset your password', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$csrf = $csrf ?? '';
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
                    ->action($urlGenerator->generate('reset', ['id' => $id, 'code' => $code]))
                    ->csrf($csrf)
                    ->id('form-recovery-reset')
                    ->begin() ?>

                    <?= $field->config($model, 'password')->passwordInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= Button::tag()
                        ->attributes(['tabindex' => ++$tab])
                        ->class('button is-block is-info is-fullwidth')
                        ->content($translator->translate('Continue', [], 'user-view'))
                        ->id('reset-button')
                        ->type('submit') ?>
                <?= Form::end() ?>
            </div>
        </div>
    </div>
</div>
