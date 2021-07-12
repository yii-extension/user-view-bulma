<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\Simple\Model\ModelInterface;
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
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Request your password', [], 'user-view'));

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
                    ->action($urlGenerator->generate('request'))
                    ->csrf($csrf)
                    ->id('form-recovery-request')
                    ->begin() ?>

                    <?= $field->config($model, 'email')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= Button::tag()
                        ->attributes(['tabindex' => ++$tab])
                        ->class('button is-block is-info is-fullwidth')
                        ->content($translator->translate('Continue', [], 'user-view'))
                        ->id('request-button')
                        ->type('submit') ?>
                <?= Form::end() ?>
            </div>
        </div>

        <footer class="card-footer has-text-centered is-justify-content-center">
            <hr class="mt-1"/>

            <?php $items = Li::tag()
                ->class('list-group-item text-center')
                ->content(
                    A::tag()
                        ->attributes(['tabindex' => ++$tab])
                        ->class('has-text-link')
                        ->content($translator->translate('Already registered - Sign in!', [], 'user-view'))
                        ->url($urlGenerator->generate('login'))
                        ->render()
                )
                ->encode(false)
            ?>

            <?= Ul::tag()->class('card-footer list-group list-group-flush mb-2 ')->items($items) ?>

            <hr class="pb-3"/>
        </footer>
    </div>
</div>
