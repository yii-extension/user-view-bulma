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
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var UserParameter $userParameter
 * @var WebView $this
 *
 * @psalm-suppress InvalidScope
 */

$title = Html::encode($translator->translate('Recover your password'));
$this->setTitle($title);

$assetManager->register(
    $userParameter->getAssetClass(),
);

$items = [];
$tab = 0;
?>

<h1 class="title has-text-black">
    <?= $title ?>
</h1>

<hr class="mb-2"/>

<div class="column is-4 is-offset-4">
    <?= Form::widget()
        ->action($urlGenerator->generate('request'))
        ->options(
            [
                'id' => 'form-recovery-request',
                'class' => 'forms-recovery-request bg-white shadow-md rounded px-8 pb-8',
                'csrf' => $csrf,
            ]
        )
        ->begin() ?>

        <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

        <?= Html::submitButton(
            Html::encode($translator->translate('Continue')),
            [
                'class' => 'button is-block is-info is-fullwidth',
                'id' => 'request-button',
                'tabindex' => ++$tab,
            ]
        ) ?>

    <?= Form::end() ?>

    <hr class="mt-1"/>

    <?php $items[] = Html::a(
        Html::encode($translator->translate('Already registered - Sign in!')),
        $urlGenerator->generate('login'),
        ['tabindex' => ++$tab],
    ) ?>

    <?= Html::ul(
        $items,
        [
            'encode' => false,
            'itemOptions' => ['class' => 'text-center'],
        ]
    ) ?>
</div>
