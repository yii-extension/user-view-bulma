<?php

declare(strict_types=1);

use Yii\Extension\Service\ServiceParameter;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Form\Widget\Form;
use Yiisoft\Html\Html;
use Yiisoft\I18n\Locale;
use Yiisoft\Translator\Message\Php\MessageSource;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Router\UrlMatcherInterface;
use Yiisoft\User\User;
use Yiisoft\Yii\Bulma\Nav;
use Yiisoft\Yii\Bulma\NavBar;

/**
 * @var Aliases Aliases
 * @var string|null $csrf
 * @var array $menuItems
 * @var Locale $locale
 * @var MessageSource $translator
 * @var ServiceParameter $serviceParameter
 * @var UrlGeneratorInterface $urlGenerator
 * @var UrlMatcherInterface $urlMatcher
 * @var User $user
 */

$menuItems = $serviceParameter->get('nav.guest');
$currentUrl = '';
$translator = new MessageSource($aliases->get('@user-view-language'));

foreach ($menuItems as $key => $value) {
    if ($value['label'] === 'Register') {
        $menuItems[$key] = array_merge(
            $menuItems[$key],
            ['label' => $translator->getMessage('Register', 'user', $locale->language()),]
        );
        $menuItems[$key] = array_merge($menuItems[$key], ['visible' => $setting->isRegister()]);
    }

    if ($value['label'] === 'Login') {
        $menuItems[$key] = array_merge(
            $menuItems[$key],
            ['label' => $translator->getMessage('Login', 'user', $locale->language()),]
        );
    }
}

if ($urlMatcher->getCurrentRoute() !== null) {
    $currentUrl = $urlMatcher->getCurrentUri()->getPath();
}

if (!$user->isGuest()) {
    $menuItems = [
        [
            'label' => Form::widget()
                ->action($urlGenerator->generate('logout'))
                ->options(['csrf' => $csrf])
                ->begin() .
                    Html::submitButton(
                        'Logout (' . Html::encode($user->getIdentity()->getUsername()) . ')',
                        ['class' => 'button is-black is-inverted', 'id' => 'logout'],
                    ) .
                Form::end()
        ]
    ];
}

?>

<?= NavBar::widget($serviceParameter->get('navBar.config'))->begin() ?>

    <?= Nav::widget()
        ->currentPath($currentUrl)
        ->items($menuItems)
        ->encodeLabels(false)
    ?>

<?= NavBar::end();
