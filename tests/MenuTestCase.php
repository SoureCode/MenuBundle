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

use Nyholm\BundleTest\TestKernel;
use SoureCode\Bundle\Menu\SoureCodeMenuBundle;
use SoureCode\Bundle\Menu\Tests\App\CompilerPass\AuthenticatorCompilerPass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class MenuTestCase extends KernelTestCase
{
    protected static function createKernel(array $options = []): KernelInterface
    {
        /**
         * @var TestKernel $kernel
         */
        $kernel = parent::createKernel($options);

        $kernel->addTestBundle(SoureCodeMenuBundle::class);
        $kernel->addTestBundle(SecurityBundle::class);
        $kernel->addTestBundle(TwigBundle::class);
        $kernel->setTestProjectDir(__DIR__.'/App');
        $kernel->addTestConfig(__DIR__.'/config.yaml');
        $kernel->addTestCompilerPass(new AuthenticatorCompilerPass());
        $kernel->handleOptions($options);

        return $kernel;
    }

    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }
}
