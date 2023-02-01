<?php

namespace Hikaru\MVC\Crowdfunding\Config;

use PHPUnit\Framework\TestCase;


class DatabaseTest extends TestCase
{
    function testGetConnection() {
        $connection = Database::getConnection('production');
        self::assertNotNull($connection);
    }

    function testGetConnectionSingleton() {
        $connection1 = Database::getConnection('production');
        $connection2 = Database::getConnection('production');

        self::assertSame($connection1, $connection2);
    }
}
