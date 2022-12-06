<?php

namespace Statsm\FirstPackage;

use Statsm\FirstPackage\Exceptions\MyException;

/**
 * FirstPackage class
 */
class MyClass
{
    public function __construct()
    {
        //throw new MyException();
    }

    public function dumpParams(array $params): void
    {
        var_dump($params);
    }
}
