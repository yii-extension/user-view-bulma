<?php

use Yiisoft\Aliases\Aliases;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Translator\Message\Php\MessageSource;

/**
 * @var Aliases Aliases
 * @var Locale $locale
 * @var MessageSource $translator
 */

$this->setTitle('404');

$translator = new MessageSource($aliases->get('@user-view-language'));

?>

<h1 class='is-size-1'>
    <b>404</b>
</h1>

<p class='has-text-danger'>
    <?= $translator->getMessage('The page', 'user', $locale->language()) ?>

    <span>
        <b><?= Html::encode($urlMatcher->getCurrentUri()->getPath()) ?></b>
    </span>

    <?= $translator->getMessage('not found', 'user', $locale->language()) ?> <br/>

</p>

<p class='has-text-grey'>
    <br/>
        <?= $translator->getMessage(
            'The above error occurred while the Web server was processing your request',
            'user',
            $locale->language()
        ) ?>
    <br/>

    <?= $translator->getMessage(
        'Please contact us if you think this is a server error. thank you.',
        'user',
        $locale->language()
    ) ?>

    <br/>

</p>

<hr class='mb-2'>

<a class ='button is-danger mt-5' href=<?= $urlGenerator->generate('index') ?>>
    <?= $translator->getMessage(
        'Go Back Home',
        'user',
        $locale->language()
    ) ?>

</a>
