<?php

namespace InFw\Range;

class BaseRange implements Range 
{
    /**
     * @var int
     */
    private $min;

    /**
     * @var int
     */
    private $max;

    /**
     * Range constructor.
     * @param int $min
     * @param int $max
     */
    public function __construct($min, $max)
    {
        if (
            2 !== count(array_filter([$min, $max], function ($value) {
                return true === is_int($value);
            }))
        ) {
            throw new \InvalidArgumentException(
                'All parameters at Size object must be integers.'
            );
        }

        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }
}
