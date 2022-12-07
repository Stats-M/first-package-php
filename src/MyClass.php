<?php

namespace Statsm\FirstPackage;

use Statsm\FirstPackage\Exceptions\MyException;

/**
 * FirstPackage class
 */
class MyClass
{
    /**
     * @throws MyException
     */
    public function __construct()
    {
        throw new MyException();
    }

    /**
     * @param array $params
     * @return void
     */
    public function dumpParams(array $params): void
    {
        var_dump($params);
    }
}
