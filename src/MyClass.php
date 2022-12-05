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
}
