<?php
/*
 * This file is part of the SoureCode package.
 *
 * (c) Jason Schilling <jason@sourecode.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SoureCode\Bundle\Menu\Tests\App\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 *
 * @internal
 */
final class AuthenticatorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('security.authenticator.form_login')) {
            $authenticatorDefinition = $container->getDefinition('security.authenticator.form_login');
            $authenticatorDefinition->setPublic(true);
        }

        if ($container->hasDefinition('security.user_authenticator')) {
            $authenticatorDefinition = $container->getDefinition('security.user_authenticator');
            $authenticatorDefinition->setPublic(true);
        }
    }
}
