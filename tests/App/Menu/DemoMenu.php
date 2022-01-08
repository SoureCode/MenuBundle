<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoureCode\Bundle\Menu\Tests\App\Menu;

use SoureCode\Component\Menu\AbstractMenu;
use SoureCode\Component\Menu\Builder\MenuBuilderInterface;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class DemoMenu extends AbstractMenu
{
    public function buildMenu(MenuBuilderInterface $menuBuilder): void
    {
        $menuBuilder
            ->setLabel('Demo Menu')
            ->addItem('Tee')
            ->addLinkItem('Green', 'https://green.tee.com')->setIcon('fa-check')->end()
            ->addLinkItem('Black', 'https://black.tee.com')->end()
            ->appendDivider()
            ->root()
            ->addItem('Heros')
            ->addLinkItem('Superman', 'https://superman.com')->end()
            ->addLinkItem('Batman', 'https://batman.com')->end()
            ->root();
    }

    public function getName(): string
    {
        return 'demo_menu';
    }
}
