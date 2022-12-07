<?php

namespace Statsm\FirstPackage;

use Statsm\FirstPackage\Exceptions\MyException;

class VectorN
{
    private array $coords_;
    private static array $allowed_operations = ['+', '-', '*', '/'];
    private float $delta_ = 0.0000001;

    /**
     * VectorN constructor.
     *
     * @param float[] $coords
     */
    public function __construct(array $coords)
    {
        $this->coords_ = $coords;
    }

    /**
     * Clones other VectorN
     * @param VectorN $other
     * @return VectorN
     */
    public static function clone(VectorN $other): VectorN
    {
        $new = new static($other->coords_);
        return $new;
    }

    /**
     * Adds another vector to the current. Vectors MUST have the same dimension.
     * @param VectorN $other
     * @return VectorN
     * @throws MyException
     */
    public function add(VectorN $other): VectorN
    {
        if ($this->getDimensionsCount() != $other->getDimensionsCount()) {
            throw new MyException('Vectors must have the same dimensions');
        }

        $result = $this->coords_;
        for ($i = 0; $i < $this->getDimensionsCount(); ++$i) {
            $result[$i] += $other->coords_[$i];
        }

        return new VectorN($result);
    }

    /**
     * Subtracts another vector from the current
     * @param VectorN $other
     * @return VectorN
     * @throws MyException
     */
    public function sub(VectorN $other): VectorN
    {
        if ($this->getDimensionsCount() != $other->getDimensionsCount()) {
            throw new MyException('Vectors must have the same dimensions');
        }

        $result = $this->coords_;
        for ($i = 0; $i < $this->getDimensionsCount(); ++$i) {
            $result[$i] -= $other->coords_[$i];
        }

        return new VectorN($result);
    }

    /**
     * Multiplies current vector with another
     * @param VectorN $other
     * @return VectorN
     * @throws MyException
     */
    public function mult(VectorN $other): VectorN
    {
        if ($this->getDimensionsCount() != $other->getDimensionsCount()) {
            throw new MyException('Vectors must have the same dimensions');
        }

        $result = $this->coords_;
        for ($i = 0; $i < $this->getDimensionsCount(); ++$i) {
            $result[$i] *= $other->coords_[$i];
        }

        return new VectorN($result);
    }

    /**
     * Divides current vector by another
     * @param VectorN $other
     * @return VectorN
     * @throws MyException in case if division by zero occurs
     */
    public function div(VectorN $other): VectorN
    {
        if ($this->getDimensionsCount() != $other->getDimensionsCount()) {
            throw new MyException('Vectors must have the same dimensions');
        }

        $result = $this->coords_;
        for ($i = 0; $i < $this->getDimensionsCount(); ++$i) {
            if (!$other->coords_[$i]) {
                throw new MyException('Division by zero');
            }
            $result[$i] /= $other->coords_[$i];
        }

        return new VectorN($result);
    }

    /**
     * Scalar operation on vector
     * @param string $operation one of the following: '+', '-', '*', '/'
     * @param float  $scalarValue
     * @return VectorN
     * @throws MyException
     */
    public function scalarOperation(string $operation, float $scalarValue): VectorN
    {
        if (!in_array($operation, VectorN::$allowed_operations)) {
            throw new MyException('Operation is not allowed');
        }

        $result = $this->coords_;
        switch($operation) {
            case '+':
                for ($i = 0; $i < $this->getDimensionsCount(); ++$i) {
                    $result[$i] += $scalarValue;
                }
                break;
            case '-':
                for ($i = 0; $i < $this->getDimensionsCount(); ++$i) {
                    $result[$i] -= $scalarValue;
                }
                break;
            case '*':
                for ($i = 0; $i < $this->getDimensionsCount(); ++$i) {
                    $result[$i] *= $scalarValue;
                }
                break;
            case '/':
                for ($i = 0; $i < $this->getDimensionsCount(); ++$i) {
                    if (abs($scalarValue) < $this->delta_) {
                        throw new MyException('Division by zero');
                    }
                    $result[$i] /= $scalarValue;
                }
                break;
            default:
                throw new MyException('Unknown operation');
        }

        return new VectorN($result);
    }

    /**
     * Calculates vector length
     * @return float
     */
    public function getLength(): float
    {
        $result = 0;
        for ($i = 0; $i < $this->getDimensionsCount(); ++$i) {
            $result += pow($this->coords_[$i], 2);
        }

        return sqrt($result);
    }

    /**
     * Returns array dimensions count
     * @return int
     */
    public function getDimensionsCount(): int
    {
        return count($this->coords_);
    }

    /**
     * Checks whether 2 vectors are equal
     * @param VectorN $vector1
     * @param VectorN $vector2
     * @return bool
     */
    public static function isEqual(VectorN $vector1, VectorN $vector2): bool
    {
        if ($vector1->getDimensionsCount() != $vector2->getDimensionsCount()) {
            return false;
        }

        return $vector1->coords_ == $vector2->coords_;
    }

    /**
     * Checks whether $this vector is equal to $other
     * @param VectorN $other
     * @return bool
     */
    public function isEqualTo(VectorN $other): bool
    {
        return VectorN::isEqual($this, $other);
    }

    /**
     * Checks whether 2 vectors are NOT equal
     * @param VectorN $vector1
     * @param VectorN $vector2
     * @return bool
     */
    public static function isNotEqual(VectorN $vector1, VectorN $vector2): bool
    {
        return !VectorN::isEqual($vector1, $vector2);
    }

    /**
     * Checks whether $this vector is NOT equal to $other
     * @param VectorN $other
     * @return bool
     */
    public function isNotEqualTo(VectorN $other): bool
    {
        return !VectorN::isEqual($this, $other);
    }
}
