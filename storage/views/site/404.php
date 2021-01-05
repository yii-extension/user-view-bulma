<?php

use Yiisoft\Html\Html;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\Translator\Translator;

/**
 * @var UrlGeneratorInterface $urlGenerator
 * @var UrlMatcherInterface $urlMatcher
 * @var Translator $translator
 */

$title = Html::encode('404');

/** @psalm-suppress InvalidScope */
$this->setTitle($title);
?>

<h1 class="is-size-1">
    <b><?= $title ?></b>
</h1>

<p class="has-text-danger">
    <?= sprintf(
        Html::encode($translator->translate('The page %s was not found.')),
        Html::tag('strong', Html::encode($urlMatcher->getCurrentUri()->getPath()))
    ); ?>
</p>

<p class="has-text-grey">
    <?= Html::encode(
        $translator->translate('The above error occurred while the Web server was processing your request.')
    ) ?>
    <br/>
    <?= Html::encode(
        $translator->translate('Please contact us if you think this is a server error. Thank you.')
    ) ?>
</p>

<hr class="mb-2">

<a class ="button is-danger mt-5" href="<?= $urlGenerator->generate('site/index') ?>">
    <?= Html::encode($translator->translate('Go Back Home')) ?>
</a>
