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
class SecuredMenu extends AbstractMenu
{
    public function buildMenu(MenuBuilderInterface $menuBuilder, array $context = []): void
    {
        $menuBuilder
            ->setLabel('Secured Menu')
            ->addItem('Tee')->setGrant('ROLE_USER')
            ->addLinkItem('Green', 'https://green.tee.com')->end()
            ->addLinkItem('Black', 'https://black.tee.com')->end()
            ->root()
            ->addItem('Heros')->setGrant('ROLE_ADMIN')
            ->addLinkItem('Superman', 'https://superman.com')->end()
            ->addLinkItem('Batman', 'https://batman.com')->end()
            ->root();
    }

    public function getName(): string
    {
        return 'secured_menu';
    }
}
