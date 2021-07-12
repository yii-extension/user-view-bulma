<?php

declare(strict_types=1);

use Yii\Extension\Simple\Forms\Field;
use Yii\Extension\Simple\Forms\Form;
use Yii\Extension\Simple\Model\ModelInterface;
use Yii\Extension\User\Helper\TimeZone;
use Yii\Extension\User\Settings\ModuleSettings;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
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

$title = Html::encode($translator->translate('Profile', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$csrf = $csrf ?? '';
$tab = 0;
$timezone = new TimeZone();
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
                    ->action($urlGenerator->generate('profile'))
                    ->csrf($csrf)
                    ->id('form-profile-profile')
                    ->begin() ?>

                    <?= $field->config($model, 'name')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= $field->config($model, 'publicEmail')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= $field->config($model, 'website')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= $field->config($model, 'location')->input(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= $field->config($model, 'timezone')
                        ->dropDownList(
                            ArrayHelper::map($timezone->getAll(), 'timezone', 'name'),
                            ['tabindex' => ++$tab]
                        ) ?>

                    <?= $field->config($model, 'bio')
                        ->textarea(['class' => 'form-control textarea', 'rows' => 2,'tabindex' => ++$tab]) ?>

                    <?= Button::tag()
                        ->attributes(['tabindex' => ++$tab])
                        ->class('button is-block is-info is-fullwidth')
                        ->content($translator->translate('Save', [], 'user-view'))
                        ->id('save-profile')
                        ->type('submit') ?>
                <?= Form::end() ?>
            </div>
        </div>
    </div>
</div>
