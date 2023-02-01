<?php

namespace Hikaru\MVC\Crowdfunding\App;

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{

    public function testRenderHome()
    {
        View::renderHome('/Home/index', [
            'title' => 'Kizuna Home'
        ]);

        self::expectOutputRegex('[Kizuna Home]');
        self::expectOutputRegex('[Kizuna Crowdfunding]');
        self::expectOutputRegex('[Welcome to Kizuna Crowdfunding...]');
    }
}
