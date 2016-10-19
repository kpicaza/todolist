<?php

namespace spec\InFw\Size;

use InFw\Range\BaseRange;
use PhpSpec\ObjectBehavior;

class BaseSizeSpec extends ObjectBehavior
{
    const SIZE = 14048;
    const MIN_SIZE = 230;
    const MAX_SIZE = 74000;
    const INVALID_SIZE = 25;
    const STRING_SIZE = 'fghjfjhgfj';

    protected $range;

    function let()
    {
        $this->range = new BaseRange(
            self::MIN_SIZE,
            self::MAX_SIZE
        );
    }

    function it_must_have_size_between_max_and_min_sizes()
    {
        $this->beConstructedWith(
            self::SIZE,
            $this->range
        );

        $this->get()->shouldBe(self::SIZE);
    }

    function it_must_have_min_and_max_size_range()
    {
        $this->beConstructedWith(
            self::SIZE,
            $this->range
        );

        $this->getRange()->shouldBe($this->range);

    }

    function it_must_thrown_an_exception_when_file_size_is_not_valid()
    {
        $this->beConstructedWith(
            self::INVALID_SIZE,
            $this->range
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

    function it_must_thrown_an_exception_when_file_size_is_not_an_integer()
    {
        $this->beConstructedWith(
            self::STRING_SIZE,
            $this->range
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }
}
