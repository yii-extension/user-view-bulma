<?php

declare(strict_types=1);

use Yii\Extension\User\View\Asset\BulmaAccordionAsset;
use Yii\Extension\User\View\Asset\BulmaSwitchAsset;
use Yii\Extension\User\Settings\RepositorySetting;
use Yii\Extension\User\View\Parameter\UserParameter;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Form\FormModelInterface;
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
 * @var RepositorySetting $repositorySetting
 * @var Translator $translator
 * @var UrlGeneratorInterface $urlGenerator
 * @var UserParameter $userParameter
 * @var WebView $this
 */

$title = Html::encode($translator->translate('Module user settings'));

/** @psalm-suppress InvalidScope */
$this->setTitle($title);

$assets = array_merge(
    [BulmaAccordionAsset::class, BulmaSwitchAsset::class],
    $userParameter->getAssetClass()
);

$assetManager->register($assets);

$script = <<<JS
var accordions = bulmaAccordion.attach()
JS;

$this->registerJs($script);

$items = [];
$tab = 0;
?>

<h1 class="title has-text-centered has-text-black">
    <?= $title ?>
</h1>

<?= Form::widget()
    ->action($urlGenerator->generate('settings'))
    ->options(['csrf' => $csrf, 'id' => 'form-setting-config'])
    ->begin() ?>
    <div class="column is-4 is-offset-4">
        <section class="accordions">
            <article class="accordion is-active">
                <div class="accordion-header has-background-danger toggle">
                    <p>Enabled/disabled account delete</p>
                </div>
                <div class="accordion-body">
                    <div class="accordion-content box has-text-black">
                        <?= $field->config($data, 'delete')
                            ->enclosedByContainer(true)
                            ->template("{input}{label}")
                            ->label(true, ['label' => ' Account delete ', 'for' => 'switchDelete'])
                            ->checkbox(
                                [
                                    'autofocus' => true,
                                    'class' => 'switch is-outlined',
                                    'id' => 'switchDelete',
                                    'tabindex' => ++$tab,
                                ],
                                false,
                            ) ?>
                        <p class="mt-2">
                            If this option is to true, users will be able to completely delete their accounts.
                        </p>
                    </div>
                </div>
            </article>
            <article class="accordion">
                <div class="accordion-header has-background-info">
                    <p>Recovery</p>
                    <button class="toggle" aria-label="toggle"></button>
                </div>
                <div class="accordion-body">
                    <div class="accordion-content box has-text-black">
                        <?= $field->config($data, 'passwordRecovery')
                            ->enclosedByContainer(true)
                            ->template("{input}{label}")
                            ->label(true, ['label' => ' Password recovery ', 'for' => 'switchPasswordRecovery'])
                            ->checkbox(
                                [
                                    'class' => 'switch is-outlined',
                                    'id' => 'switchPasswordRecovery',
                                    'tabindex' => ++$tab
                                ],
                                false,
                            ) ?>
                        <p class="mt-2">
                            If this option is to true, users will be able to recovery their forgotten passwords.
                        </p>
                    </div>
                </div>
            </article>
            <article class="accordion">
                <div class="accordion-header has-background-info">
                    <p>Registration</p>
                    <button class="toggle" aria-label="toggle"></button>
                </div>
                <div class="accordion-body">
                    <div class="accordion-content box has-text-black">
                        <?= $field->config($data, 'generatingPassword')
                            ->enclosedByContainer(true)
                            ->template("{input}{label}")
                            ->label(true, ['label' => ' Generating password ', 'for' => 'switchGeneratingPassword'])
                            ->checkbox(
                                [
                                    'class' => 'switch is-outlined',
                                    'id' => 'switchGeneratingPassword',
                                    'tabindex' => ++$tab
                                ],
                                false,
                            ) ?>
                        <p class="mt-2 mb-4">
                            If this option is set to true, password field on registration page will be hidden and
                            password for user will be generated automatically. Generated password will be 8
                            characters long and will be sent to user via email.
                        </p>
                        <?= $field->config($data, 'confirmation')
                            ->enclosedByContainer(true)
                            ->template("{input}{label}")
                            ->label(true, ['label' => 'Confirmation', 'for' => 'switchConfirm'])
                            ->checkbox(
                                ['class' => 'switch is-outlined', 'id' => 'switchConfirm', 'tabindex' => ++$tab],
                                false,
                            ) ?>
                        <p class="mt-2 mb-4">
                            If this option is set to true, module sends email that contains a confirmation link that
                            user must click to complete registration.
                        </p>
                        <?= $field->config($data, 'register')
                            ->enclosedByContainer(true)
                            ->template("{input}{label}")
                            ->label(true, ['label' => ' Register ', 'for' => 'switchRegister'])
                            ->checkbox(
                                ['class' => 'switch is-outlined', 'id' => 'switchRegister', 'tabindex' => ++$tab],
                                false,
                            ) ?>
                        <p class="mt-2">
                            If this option is set to false, users will not be able to register an account. Registration
                            page will throw NotFoundHandler. However confirmation will continue working and you as an
                            administrator will be able to create an account for user from admin interface.
                        </p>
                    </div>
                </div>
            </article>
            <article class="accordion">
                <div class="accordion-header has-background-link">
                    <p>Set token confirmation and recover</p>
                    <button class="toggle" aria-label="toggle"></button>
                </div>
                <div class="accordion-body">
                    <div class="accordion-content box has-text-black">
                        <?= $field->config($data, 'tokenConfirmWithin')
                            ->enclosedByContainer(true, ['class' => 'field is-horizontal'])
                            ->label(
                                true,
                                ['class' => 'field-label has-text-left is-normal', 'label' => 'Token Confirm Within:']
                            )
                            ->textInput(['class' => 'has-width-100', 'tabindex' => ++$tab]) ?>
                        <p class="mt-2">
                            Default value: 86400 (24 hours). <br/>
                            The time in seconds before a confirmation token becomes invalid. After expiring this time
                            user have to request new confirmation token on special page.
                        </p>
                        <?= $field->config($data, 'tokenRecoverWithin')
                            ->enclosedByContainer(true, ['class' => 'field is-horizontal mt-4'])
                            ->label(
                                true,
                                ['class' => 'field-label has-text-left is-normal', 'label' => 'Token Recover Within:']
                            )
                            ->textInput(['class' => 'has-width-100', 'tabindex' => ++$tab]) ?>
                        <p class="mt-2">
                            Default value: 21600 (6 hours). <br/>
                            The time in seconds before a recovery token becomes invalid. After expiring this time user
                            have to request new recovery message.
                        </p>
                    </div>
                </div>
            </article>
            <article class="accordion">
                <div class="accordion-header has-background-link">
                    <p>Mailer</p>
                    <button class="toggle" aria-label="toggle"></button>
                </div>
                <div class="accordion-body">
                    <div class="accordion-content box has-text-black">
                        <?= $field->config($data, 'emailFrom')->textInput(['tabindex' => ++$tab]) ?>
                        <p class="mt-2 mb-4">
                            The email address from where they will be sent.
                        </p>
                        <?= $field->config($data, 'subjectConfirm')->textInput(['tabindex' => ++$tab]) ?>
                        <p class="mt-2 mb-4">
                            The subject of the confirmation email.
                        </p>
                        <?= $field->config($data, 'subjectPassword')->textInput(['tabindex' => ++$tab]) ?>
                        <p class="mt-2 mb-4">
                            The subject of the new password email message.
                        </p>
                        <?= $field->config($data, 'subjectReconfirmation')->textInput(['tabindex' => ++$tab]) ?>
                        <p class="mt-2 mb-4">
                            The subject of the change email message.
                        </p>
                        <?= $field->config($data, 'subjectRecovery')->textInput(['tabindex' => ++$tab]) ?>
                        <p class="mt-2 mb-4">
                            The subject of the recovery password message.
                        </p>
                        <?= $field->config($data, 'subjectWelcome')->textInput(['tabindex' => ++$tab]) ?>
                        <p class="mt-2 mb-4">
                            The subject of the welcome register message.
                        </p>
                    </div>
                </div>
            </article>
            <article class="accordion">
                <div class="accordion-header has-background-black">
                    <p>Other</p>
                    <button class="toggle" aria-label="toggle"></button>
                </div>
                <div class="accordion-body">
                    <div class="accordion-content box has-text-black">
                        <?= $field->config($data, 'usernameCaseSensitive')
                            ->enclosedByContainer(true)
                            ->template("{input}{label}")
                            ->label(true, ['label' => ' Case sensitive ', 'for' => 'switchCaseSensitive'])
                            ->checkbox(
                                ['class' => 'switch is-outlined', 'id' => 'switchCaseSensitive', 'tabindex' => ++$tab],
                                false,
                            ) ?>
                        <p class="mt-2 mb-4">
                            If this option is set to true, difference between upper and lower case, for username.
                        </p>
                        <?= $field->config($data, 'headerMessage')->textInput(['tabindex' => ++$tab]) ?>
                        <p class="mt-2 mb-4">
                            The header that will be displayed in flash messages.
                        </p>
                        <?= $field->config($data, 'usernameRegExp')->textInput(['tabindex' => ++$tab]) ?>
                        <p class="mt-2">
                            Default username regex expression validation.
                        </p>
                    </div>
                </div>
            </article>
        </section>
        <?= Html::submitButton(
            $translator->translate('Save '),
            [
                'class' => 'button is-block is-info is-fullwidth mt-2',
                'id' => 'settings-button',
                'tabindex' => ++$tab
            ]
        ) ?>
    </div>
<?= Form::end() ?>
