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

    public function fromVector2D(Vector2D $other)
    {
        $this->x_ = $other->x_;
        $this->y_ = $other->y_;
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
     * Substracts another vector from the current
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
     * @param string $operation
     * @param float $scalarValue
     * @return $this
     * @throws MyException
     */
    public function scalarOperation(string $operation, float $scalarValue): Vector2D
    {
        if (!in_array($operation, Vector2D::$allowed_operations)) {
            throw new MyException('Operation is not allowed');
        }

        switch($operation) {
            case '+':
                $this->x_ += $scalarValue;
                $this->y_ += $scalarValue;
                break;
            case '-':
                $this->x_ -= $scalarValue;
                $this->y_ -= $scalarValue;
                break;
            case '*':
                $this->x_ *= $scalarValue;
                $this->y_ *= $scalarValue;
                break;
            case '/':
                if (abs($scalarValue) < $this->delta_) {
                    throw new MyException('Division by zero');
                }
                $this->x_ /= $scalarValue;
                $this->y_ /= $scalarValue;
                break;
            default:
                throw new MyException('Unknown operation');
        }

        return new Vector2D($this->x_, $this->y_);
    }

    /**
     * Calculates vector length
     * @return float
     */
    public function length(): float
    {
        return sqrt(($this->x_)^2 + ($this->y_)^2);
    }
}
