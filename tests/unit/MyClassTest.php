<?php

namespace Statsm\FirstPackage\Tests\Unit;

use Codeception\Test\Unit;
use Statsm\FirstPackage\Exceptions\MyException;
use Statsm\FirstPackage\MyClass;

class MyClassTest extends Unit
{
    /**
     * @return void
     */
    public function testFirst()
    {
        try {
            new MyClass();
        } catch(MyException $e) {}
    }
}
