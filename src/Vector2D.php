<?php

namespace Statsm\FirstPackage;

use Statsm\FirstPackage\Exceptions\MyException;

class Vector2D
{
    private float $x_;
    private float $y_;
    private static array $allowed_operations = ['+', '-', '*', '/'];
    private float $delta_ = 0.0000001;

    /**
     * @param float $x
     * @param float $y
     */
    public function __construct(float $x, float $y)
    {
        $this->x_ = $x;
        $this->y_ = $y;
    }

    /**
     * Clones others Vector2D
     * @param Vector2D $other
     * @return Vector2D
     */
    public static function clone(Vector2D $other): Vector2D
    {
        $new = new static($other->x_, $other->y_);
        return $new;
    }

    /**
     * Adds another vector to the current
     * @param Vector2D $other
     * @return Vector2D
     */
    public function add(Vector2D $other): Vector2D
    {
        return new Vector2D(
            $this->x_ + $other->x_,
            $this->y_ + $other->y_,
        );
    }

    /**
     * Subtracts another vector from the current
     * @param Vector2D $other
     * @return Vector2D
     */
    public function sub(Vector2D $other): Vector2D
    {
        return new Vector2D(
            $this->x_ - $other->x_,
            $this->y_ - $other->y_,
        );
    }

    /**
     * Multiplies current vector with another
     * @param Vector2D $other
     * @return Vector2D
     */
    public function mult(Vector2D $other): Vector2D
    {
        return new Vector2D(
            $this->x_ * $other->x_,
            $this->y_ * $other->y_,
        );
    }

    /**
     * Divides current vector by another
     * @param Vector2D $other
     * @return Vector2D
     * @throws MyException in case if division by zero occurs
     */
    public function div(Vector2D $other): Vector2D
    {
        if (!$other->x_ || !$other->y_) {
            throw new MyException('Division by zero');
        }
        return new Vector2D(
            $this->x_ / $other->x_,
            $this->y_ / $other->y_,
        );
    }

    /**
     * Scalar operation on vector
     * @param string $operation one of the following: '+', '-', '*', '/'
     * @param float  $scalarValue
     * @return Vector2D
     * @throws MyException
     */
    public function scalarOperation(string $operation, float $scalarValue): Vector2D
    {
        if (!in_array($operation, Vector2D::$allowed_operations)) {
            throw new MyException('Operation is not allowed');
        }

        switch($operation) {
            case '+':
                return new Vector2D($this->x_ + $scalarValue, $this->y_ + $scalarValue);
            case '-':
                return new Vector2D($this->x_ - $scalarValue, $this->y_ - $scalarValue);
            case '*':
                return new Vector2D($this->x_ * $scalarValue, $this->y_ * $scalarValue);
            case '/':
                if (abs($scalarValue) < $this->delta_) {
                    throw new MyException('Division by zero');
                }
                return new Vector2D($this->x_ / $scalarValue, $this->y_ / $scalarValue);
            default:
                throw new MyException('Unknown operation');
        }
    }

    /**
     * Calculates vector length
     * @return float
     */
    public function getLength(): float
    {
        return sqrt(pow($this->x_,2) + pow($this->y_,2));
    }

    /**
     * Checks whether 2 vectors are equal
     * @param Vector2D $vector1
     * @param Vector2D $vector2
     * @return bool
     */
    public static function isEqual(Vector2D $vector1, Vector2D $vector2): bool
    {
        return ($vector1->x_ == $vector2->x_) && ($vector1->y_ == $vector2->y_);
    }

    /**
     * Checks whether $this vector is equal to $other
     * @param Vector2D $other
     * @return bool
     */
    public function isEqualTo(Vector2D $other): bool
    {
        return Vector2D::isEqual($this, $other);
    }

    /**
     * Checks whether 2 vectors are NOT equal
     * @param Vector2D $vector1
     * @param Vector2D $vector2
     * @return bool
     */
    public static function isNotEqual(Vector2D $vector1, Vector2D $vector2): bool
    {
        return !Vector2D::isEqual($vector1, $vector2);
    }

    /**
     * Checks whether $this vector is NOT equal to $other
     * @param Vector2D $other
     * @return bool
     */
    public function isNotEqualTo(Vector2D $other): bool
    {
        return !Vector2D::isEqual($this, $other);
    }
}
