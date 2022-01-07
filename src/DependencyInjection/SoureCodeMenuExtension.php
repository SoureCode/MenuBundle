<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoureCode\Bundle\Menu\DependencyInjection;

use SoureCode\Component\Menu\AbstractMenu;
use SoureCode\Component\Menu\MenuRegistryInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class SoureCodeMenuExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../../config'));

        $loader->load('services.php');

        $container->registerForAutoconfiguration(AbstractMenu::class)
            ->addTag('soure_code.menu');
    }

    public function prepend(ContainerBuilder $container): void
    {
        if (!$container->hasExtension('twig')) {
            return;
        }

        $reflectionClass = new \ReflectionClass(MenuRegistryInterface::class);
        $path = \dirname($reflectionClass->getFileName()).'/Resources/views';

        $container->prependExtensionConfig('twig', ['paths' => [$path]]);
    }
}
