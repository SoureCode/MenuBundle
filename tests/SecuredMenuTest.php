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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\Security\Core\User\InMemoryUser;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Jason Schilling <jason@sourecode.dev>
 */
class SecuredMenuTest extends MenuTestCase
{
    public function testRenderAsAnonymous(): void
    {
        self::bootKernel();

        $environment = self::getContainer()->get('twig');

        $output = $environment->render('secured_menu.html.twig');

        $this->assertSame(<<<'EOF'
Example foo bar

<div class="test">
    <nav><ol></ol></nav>
</div>

EOF, $output);
    }

    public function testRenderAsUser(): void
    {
        self::bootKernel();

        $user = new InMemoryUser('foo', 'bar', ['ROLE_USER']);
        $this->login($user);

        $environment = self::getContainer()->get('twig');

        $output = $environment->render('secured_menu.html.twig');

        $this->assertSame(<<<'EOF'
Example foo bar

<div class="test">
    <nav><ol><li><span>Tee</span><ol><li><a href="https://green.tee.com">Green</a></li><li><a href="https://black.tee.com">Black</a></li></ol></li></ol></nav>
</div>

EOF, $output);
    }

    public function testRenderAsAdmin(): void
    {
        self::bootKernel();

        $user = new InMemoryUser('foo', 'bar', ['ROLE_USER', 'ROLE_ADMIN']);
        $this->login($user);

        $environment = self::getContainer()->get('twig');

        $output = $environment->render('secured_menu.html.twig');

        $this->assertSame(<<<'EOF'
Example foo bar

<div class="test">
    <nav><ol><li><span>Tee</span><ol><li><a href="https://green.tee.com">Green</a></li><li><a href="https://black.tee.com">Black</a></li></ol></li><li><span>Heros</span><ol><li><a href="https://superman.com">Superman</a></li><li><a href="https://batman.com">Batman</a></li></ol></li></ol></nav>
</div>

EOF, $output);
    }

    private function login(UserInterface $user)
    {
        $requestStack = self::getContainer()->get('request_stack');
        $requestStack->push(Request::create('/'));
        $request = $requestStack->getCurrentRequest();
        $storage = new MockFileSessionStorage();
        $request->setSession(new Session($storage));
        $formAuthenticator = self::getContainer()->get('security.authenticator.form_login.main');

        $authenticator = self::getContainer()->get('security.user_authenticator');
        $authenticator->authenticateUser($user, $formAuthenticator, $request);
    }
}
