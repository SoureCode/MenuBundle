<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoureCode\Bundle\Menu\Tests;

use SoureCode\Component\Menu\Matcher\MatcherInterface;
use SoureCode\Component\Menu\MenuRegistryInterface;
use SoureCode\Component\Menu\Model\Menu;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class DependencyInjectionTest extends MenuTestCase
{
    public function testBuildMenu(): void
    {
        $kernel = static::bootKernel();
        $container = $kernel->getContainer();

        $menuRegistry = $container->get(MenuRegistryInterface::class);

        $menu = $menuRegistry->build('demo_menu');

        self::assertInstanceOf(Menu::class, $menu);
        self::assertSame('demo_menu', $menu->getName());
        self::assertSame('Demo Menu', $menu->getLabel());
    }

    public function testServices(): void
    {
        $kernel = static::bootKernel();
        $container = $kernel->getContainer();

        self::assertTrue($container->has(MenuRegistryInterface::class));
        self::assertTrue($container->has(MatcherInterface::class));
    }
}
