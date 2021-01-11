<?php

declare(strict_types=1);

use Yiisoft\Form\FormModelInterface;
use Yii\Extension\User\View\Parameter\UserParameter;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;

/**
 * @var AssetManager $assetManager
 * @var string $code
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var string $id
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var UserParameter $userParameter
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Reset your password'));

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
                    ->action($urlGenerator->generate('reset', ['id' => $id, 'code' => $code]))
                    ->options(['csrf' => $csrf, 'id' => 'form-recovery-reset'])
                    ->begin() ?>

                    <?= $field->config($data, 'password')->passwordInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= Html::submitButton(
                        Html::encode($translator->translate('Continue')),
                        [
                            'class' => 'button is-block is-info is-fullwidth',
                            'id' => 'reset-button',
                            'tabindex' => ++$tab,
                        ]
                    ) ?>

                <?= Form::end() ?>
            </div>
        </div>
    </div>
</div>
