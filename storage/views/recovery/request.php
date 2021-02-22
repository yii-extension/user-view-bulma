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
 * @var string|null $csrf
 * @var FormModelInterface $data
 * @var Field $field
 * @var TranslatorInterface $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var UserParameter $userParameter
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Request your password', [], 'user-view'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$assetManager->register($userParameter->getAssetClass());

$items = [];
$tab = 0;
?>

<div class="column is-4 is-offset-4">
    <div class="card">
        <header class="card-header">
            <h1 class="card-header-title has-text-black has-text-centered is-justify-content-center title">
                <?= $title ?>
            </h1>
        </header>

        <div class="card-content">
            <div class="content">
                <?= Form::widget()
                    ->action($urlGenerator->generate('request'))
                    ->options(['csrf' => $csrf, 'id' => 'form-recovery-request'])
                    ->begin() ?>

                    <?= $field->config($data, 'email')->textInput(['autofocus' => true, 'tabindex' => ++$tab]) ?>

                    <?= Html::submitButton(
                        Html::encode($translator->translate('Continue', [], 'user-view')),
                        [
                            'class' => 'button is-block is-info is-fullwidth',
                            'id' => 'request-button',
                            'tabindex' => ++$tab,
                        ]
                    ) ?>

                <?= Form::end() ?>
            </div>
        </div>

        <footer class="card-footer has-text-centered is-justify-content-center">
            <hr class="mt-1"/>

            <?php $items[] = Html::a(
                Html::encode($translator->translate('Already registered - Sign in!', [], 'user-view')),
                $urlGenerator->generate('login'),
                ['class' => 'has-text-link', 'tabindex' => ++$tab],
            ) ?>

            <?= Html::ul()->strings($items, false) ?>

            <hr class="pb-3"/>
        </footer>
    </div>
</div>
