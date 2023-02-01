<?php

namespace Hikaru\MVC\Crowdfunding;

use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase
{
    public function testRegex()
    {
        $path = "/products/73187asjhak/categories/10212kdkhsdAdjad";

        $pattern = "#^/products/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)$#";

        $result = preg_match($pattern, $path, $values);

        self::assertEquals(1, $result);

        var_dump($values);

        // array_shift digunakan untuk cut index 0
        array_shift($values);
        var_dump($values);

    }
}

