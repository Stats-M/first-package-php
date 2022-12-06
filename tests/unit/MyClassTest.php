<?php

namespace Statsm\FirstPackage\Tests\Unit;

use Statsm\FirstPackage\Exceptions\MyException;
use Statsm\FirstPackage\MyClass;
use Statsm\FirstPackage\Vector2D;

class MyClassTest extends \Codeception\Test\Unit
{
    /**
     * @return void
     */
    public function testFirst()
    {
        $test = new MyClass();
        $test->dumpParams([
            4,
            5,
            7 => 6,
            6,
        ]);
        /*
        try {
            new MyClass();
        } catch(MyException $e) {}
        */
    }

    /**
     * @return void
     * @throws MyException
     */
    public function testVectorOperations()
    {
        $vector1 = new Vector2D(2, 8);
        $vector2 = new Vector2D(4, 4);

        $vectorAdd = $vector1->add($vector2);
        $vectorSub = $vector1->sub($vector2);
        $vectorMult = $vector1->mult($vector2);
        $vectorDiv = $vector1->div($vector2);

        $this->assertEquals(new Vector2D(6, 12), $vectorAdd);
        $this->assertEquals(new Vector2D(-2, 4), $vectorSub);
        $this->assertEquals(new Vector2D(8, 32), $vectorMult);
        $this->assertEquals(new Vector2D(0.5, 2), $vectorDiv);

        $vector3 = new Vector2D(1, 0);
        try {
            $result = $vector1->div($vector3);
            $this->fail();
        } catch(MyException $e) {
            // OK. Just catch exception of our type silently
        }

        $vector4 = new Vector2D(0, 1);
        try {
            $result = $vector1->div($vector4);
            $this->fail();
        } catch(MyException $e) {
            // OK. Just catch exception of our type silently
        }
    }

    /**
     * @return void
     * @throws MyException
     */
    public function testScalarOperations()
    {
        $vector1 = new Vector2D(4, 8);

        $vectorScalarAdd = $vector1->scalarOperation('+', 2);
        $vectorScalarSub = $vector1->scalarOperation('-', 2);
        $vectorScalarMult = $vector1->scalarOperation('*', 2);
        $vectorScalarDiv = $vector1->scalarOperation('/', 2);

        $this->assertEquals(new Vector2D(6, 10), $vectorScalarAdd);
        $this->assertEquals(new Vector2D(2, 6), $vectorScalarSub);
        $this->assertEquals(new Vector2D(8, 16), $vectorScalarMult);
        $this->assertEquals(new Vector2D(2, 4), $vectorScalarDiv);

        try {
            $result = $vector1->scalarOperation('/', 0);
            $this->fail();
        } catch(MyException $e) {
            // OK. Just catch exception of our type silently
        }
    }
}
