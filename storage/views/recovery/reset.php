<?php

declare(strict_types=1);

use Yiisoft\Form\FormModelInterface;
use Yii\Extension\User\View\Parameter\UserParameter;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\Widget\Field;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\Translator;
use Yiisoft\View\WebView;

/**
 * @var AssetManager $assetManager
 * @var string $code
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var string $id
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var UserParameter $userParameter
 * @var WebView $this
 *
 * @psalm-suppress InvalidScope
 */

$this->setTitle('Reset your password.');

$assetManager->register(
    $userParameter->getAssetClass(),
);
?>

<h1 class="title has-text-black">
    <?= $translator->translate('Reset your password') ?>
</h1>

<hr class="mb-2"/>

<div class="column is-4 is-offset-4">
    <?= Form::widget()
        ->action($urlGenerator->generate('reset', ['id' => $id, 'code' => $code]))
        ->options(
            [
                'id' => 'form-recovery-reset',
                'class' => 'forms-recovery-reset bg-white shadow-md rounded px-8 pb-8',
                'csrf' => $csrf
            ]
        )
        ->begin() ?>

        <?= $field->config($data, 'password')->passwordInput(['autofocus' => true, 'tabindex' => '1']) ?>

        <?= Html::submitButton(
            $translator->translate('Continue'),
            [
                'class' => 'button is-block is-info is-fullwidth',
                'name' => 'reset-button',
                'tabindex' => '2'
            ]
        ) ?>

    <?php Form::end() ?>
</div>
