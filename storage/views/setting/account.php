<?php

declare(strict_types=1);

use Yii\Extension\User\Asset\SettingAsset;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Html\Html;

/**
 * @var AssetManager $assetManager
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var RepositorySetting $repositorySetting
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var UserParameter $userParameter
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Account setting'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$assetManager->register($userParameter->getAssetClass());

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
                    ->action($urlGenerator->generate('account'))
                    ->options(['csrf' => $csrf, 'class' => 'forms-settings-account', 'id' => 'form-settings-account'])
                    ->begin() ?>

                    <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= $field->config($data, 'username')->textInput(['tabindex' => ++$tab]) ?>

                    <?= Html::submitButton(
                        Html::encode($translator->translate('Save')),
                        [
                            'class' => 'button is-block is-info is-fullwidth',
                            'id' => 'save-account',
                            'tabindex' => ++$tab,
                        ]
                    ) ?>

                <?= Form::end() ?>
            </div>
        </div>
    </div>
</div>
