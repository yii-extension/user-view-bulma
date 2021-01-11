<?php

declare(strict_types=1);

use Yii\Extension\User\Helper\TimeZone;
use Yii\Extension\User\Settings\RepositorySetting;
use Yii\Extension\User\View\Parameter\UserParameter;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\FormModelInterface;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

/**
 * @var AssetManager $assetManager
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var RepositorySetting $repositorySetting
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var UserParameter $userParameter
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Profile'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$assetManager->register($userParameter->getAssetClass());

$timezone = new TimeZone();

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
                    ->action($urlGenerator->generate('profile'))
                    ->options(['csrf' => $csrf, 'id' => 'form-profile-profile'])
                    ->begin() ?>

                    <?= $field->config($data, 'name')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= $field->config($data, 'publicEmail')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= $field->config($data, 'website')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= $field->config($data, 'location')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= $field->config($data, 'timezone')
                        ->enclosedByContainer(true, ['class' => 'select'])
                        ->dropDownList(
                            ArrayHelper::map($timezone->getAll(), 'timezone', 'name'),
                            ['tabindex' => ++$tab]
                        ) ?>

                    <?= $field->config($data, 'bio')
                        ->textarea(['class' => 'form-control textarea', 'rows' => 2,'tabindex' => ++$tab]) ?>

                    <?= Html::submitButton(
                        Html::encode($translator->translate('Save')),
                        [
                            'class' => 'button is-block is-info is-fullwidth',
                            'id' => 'save-profile',
                            'tabindex' => ++$tab,
                        ]
                    ) ?>

                <?= Form::end() ?>
            </div>
        </div>
    </div>
</div>
