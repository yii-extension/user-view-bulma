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

$title = Html::encode($translator->translate('Reset your password'));
$this->setTitle($title);

$assetManager->register(
    $userParameter->getAssetClass(),
);

$tab = 0;
?>

<h1 class="title has-text-black">
    <?= $title ?>
</h1>

<hr class="mb-2"/>

<div class="column is-4 is-offset-4">
    <?= Form::widget()
        ->action($urlGenerator->generate('reset', ['id' => $id, 'code' => $code]))
        ->options(
            [
                'id' => 'form-recovery-reset',
                'class' => 'forms-recovery-reset bg-white shadow-md rounded px-8 pb-8',
                'csrf' => $csrf,
            ]
        )
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
