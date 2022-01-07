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

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class TwigTest extends MenuTestCase
{
    public function testRender(): void
    {
        self::bootKernel();

        $environment = self::getContainer()->get('twig');

        $output = $environment->render('base.html.twig');

        $this->assertSame(<<<'EOF'
Example foo bar

<div class="test">
    <nav><ol><li><span>Tee</span><ol><li><a href="https://green.tee.com"><span class="fa fa-fw fa-check"></span> Green</a></li><li><a href="https://black.tee.com">Black</a></li></ol></li><li><span>Heros</span><ol><li><a href="https://superman.com">Superman</a></li><li><a href="https://batman.com">Batman</a></li></ol></li></ol></nav>
</div>

EOF, $output);
    }

    public function testRenderTemplate(): void
    {
        self::bootKernel();

        $environment = self::getContainer()->get('twig');

        $output = $environment->render('template.html.twig');

        $this->assertSame(<<<'EOF'
Example foo bar

<div class="test">
    <nav><ol class="nav flex-column"><li class="nav-item"><span class="nav-link">Tee</span><ol class="nav flex-column"><li class="nav-item"><a class="nav-link" href="https://green.tee.com"><span class="fa fa-fw fa-check"></span> Green</a></li><li class="nav-item"><a class="nav-link" href="https://black.tee.com">Black</a></li></ol></li><li class="nav-item"><span class="nav-link">Heros</span><ol class="nav flex-column"><li class="nav-item"><a class="nav-link" href="https://superman.com">Superman</a></li><li class="nav-item"><a class="nav-link" href="https://batman.com">Batman</a></li></ol></li></ol></nav>
</div>

EOF, $output);
    }
}
