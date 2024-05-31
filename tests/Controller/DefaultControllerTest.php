<?php

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

class DefaultControllerTest extends PantherTestCase
{
    public function testHomepage()
    {
        $client = static::createPantherClient(['browser' => static::FIREFOX]);

        $client->request('GET', '/');

        $mouse = $client->getMouse();
        $mouse->mouseDownTo('canvas');
        $mouse->mouseMoveTo('canvas', 100, 60);

        $client->takeScreenshot('screen.png');
    }
}
