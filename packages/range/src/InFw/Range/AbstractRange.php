<?php

/**
 * This file is part of InFw\Range package.
 */

namespace InFw\Range;

/**
 * Class AbstractRange.
 */
abstract class AbstractRange implements Range
{
    /**
     * Range minimum value.
     *
     * @var int
     */
    private $min;

    /**
     * Range maximum value.
     *
     * @var int
     */
    private $max;

    /**
     * Range constructor.
     *
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
     * Get Range min value.
     *
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * Get Range max value.
     *
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }
}
