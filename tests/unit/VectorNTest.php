<?php

namespace Statsm\FirstPackage\Tests\Unit;

use Codeception\Test\Unit;
use Statsm\FirstPackage\Exceptions\MyException;
use Statsm\FirstPackage\VectorN;

class VectorNTest extends Unit
{

    /**
     * @return void
     * @throws MyException
     */
    public function testVectorOperations()
    {
        $vector1 = new VectorN([2, 8, 6, 4]);
        $vector2 = new VectorN([2, 2, 2, 2]);

        $vectorAdd = $vector1->add($vector2);
        $vectorSub = $vector1->sub($vector2);
        $vectorMult = $vector1->mult($vector2);
        $vectorDiv = $vector1->div($vector2);

        $this->assertEquals(new VectorN([4, 10, 8, 6]), $vectorAdd);
        $this->assertEquals(new VectorN([0, 6, 4, 2]), $vectorSub);
        $this->assertEquals(new VectorN([4, 16, 12, 8]), $vectorMult);
        $this->assertEquals(new VectorN([1, 4, 3, 2]), $vectorDiv);

        $vector3 = new VectorN([4, 10, 0, 6]);
        try {
            $result = $vector1->div($vector3);
            $this->fail();
        } catch (MyException $e) {
            // OK. Just catch exception of our type silently
        }

        $vector4 = new VectorN([4, 0, 8, 6]);
        try {
            $result = $vector1->div($vector4);
            $this->fail();
        } catch (MyException $e) {
            // OK. Just catch exception of our type silently
        }
    }

    /**
     * @return void
     * @throws MyException
     */
    public function testScalarOperations()
    {
        $vector1 = new VectorN([2, 8.0, 6.6, 10]);

        $vectorScalarAdd = $vector1->scalarOperation('+', 2);
        $vectorScalarSub = $vector1->scalarOperation('-', 2);
        $vectorScalarMult = $vector1->scalarOperation('*', 2);
        $vectorScalarDiv = $vector1->scalarOperation('/', 2);

        $this->assertEquals(new VectorN([4, 10.0, 8.6, 12]), $vectorScalarAdd);
        $this->assertEquals(new VectorN([0, 6.0, 4.6, 8]), $vectorScalarSub);
        $this->assertEquals(new VectorN([4, 16.0, 13.2, 20]), $vectorScalarMult);
        $this->assertEquals(new VectorN([1, 4.0, 3.3, 5]), $vectorScalarDiv);

        try {
            $result = $vector1->scalarOperation('/', 0);
            $this->fail();
        } catch (MyException $e) {
            // OK. Just catch exception of our type silently
        }
    }

    /**
     * @return void
     */
    public function testLength()
    {
        $vector = new VectorN([2, 3, 4]);

        $this->assertEquals(sqrt(pow(2,2) + pow(3,2) + pow(4,2)),
            $vector->getLength());
    }

    /**
     * @return void
     */
    public function testEquality()
    {
        $vector1 = new VectorN([1.0, 2.5, 8.23, 4]);
        $vector2 = new VectorN([1, 2.5, 8.23, 4.0]);
        $vector3 = new VectorN([1.0, 3.5, 8.23, 4]);
        $vector4 = new VectorN([6.0, 2.5, 8.23, 4.12]);
        $vector5 = new VectorN([1.57, 8.5, 3, 2.56]);

        // 2 arguments version
        $this->assertTrue(VectorN::isEqual($vector1, $vector2));
        $this->assertFalse(VectorN::isEqual($vector1, $vector3));
        $this->assertFalse(VectorN::isEqual($vector1, $vector4));
        $this->assertFalse(VectorN::isEqual($vector1, $vector5));

        // 1 argument version
        $this->assertTrue($vector1->isEqualTo($vector2));
        $this->assertFalse($vector1->isEqualTo($vector3));
        $this->assertFalse($vector1->isEqualTo($vector4));
        $this->assertFalse($vector1->isEqualTo($vector5));

        // 2 arguments version
        $this->assertFalse(VectorN::isNotEqual($vector1, $vector2));
        $this->assertTrue(VectorN::isNotEqual($vector1, $vector3));
        $this->assertTrue(VectorN::isNotEqual($vector1, $vector4));
        $this->assertTrue(VectorN::isNotEqual($vector1, $vector5));

        // 1 argument version
        $this->assertFalse($vector1->isNotEqualTo($vector2));
        $this->assertTrue($vector1->isNotEqualTo($vector3));
        $this->assertTrue($vector1->isNotEqualTo($vector4));
        $this->assertTrue($vector1->isNotEqualTo($vector5));
    }
}
