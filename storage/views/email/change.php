<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\Simple\Model\ModelInterface;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

/**
 * @var string|null $csrf
 * @var Field $field
 * @var ModelInterface $model
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Change email address', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$csrf = $csrf ?? '';
$tab = 0;
?>

<div class="column is-4 is-offset-4">
    <div class="card">
        <header class="card-header">
            <h1 class="card-header-title has-text-black is-justify-content-center is-size-4 title">
                <?= $title ?>
            </h1>
        </header>

        <div class="card-content">
            <div class="content has-text-left">
                <?= Form::widget()
                    ->action($urlGenerator->generate('email/change'))
                    ->csrf($csrf)
                    ->id('form-email-change')
                    ->begin() ?>

                    <?= $field->config($model, 'email')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= Button::tag()
                        ->attributes(['tabindex' => ++$tab])
                        ->class('button is-block is-info is-fullwidth')
                        ->content($translator->translate('Save', [], 'user-view'))
                        ->id('save-email-change')
                        ->type('submit') ?>
                <?= Form::end() ?>
            </div>
        </div>
    </div>
</div>
