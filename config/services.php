<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use SoureCode\Component\Menu\Matcher\Matcher;
use SoureCode\Component\Menu\Matcher\MatcherInterface;
use SoureCode\Component\Menu\MenuRegistry;
use SoureCode\Component\Menu\MenuRegistryInterface;
use SoureCode\Component\Menu\Twig\MenuExtension;
use SoureCode\Component\Menu\Twig\MenuRuntime;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $services->set('soure_code.menu.registry', MenuRegistry::class);
    $services
        ->alias(MenuRegistryInterface::class, 'soure_code.menu.registry')
        ->public();

    $services->set('soure_code.menu.matcher', Matcher::class)
        ->args([
            service('request_stack'),
        ]);
    $services
        ->alias(MatcherInterface::class, 'soure_code.menu.matcher')
        ->public();

    $services->set('soure_code.menu.twig.extension', MenuExtension::class)
        ->tag('twig.extension');

    $services->set('soure_code.menu.twig.runtime', MenuRuntime::class)
        ->args([
            service('soure_code.menu.registry'),
            service('soure_code.menu.matcher'),
        ])
        ->tag('twig.runtime');
};
