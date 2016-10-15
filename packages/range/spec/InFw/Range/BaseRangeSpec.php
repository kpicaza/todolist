<?php

namespace spec\InFw\Range;

use PhpSpec\ObjectBehavior;

class BaseRangeSpec extends ObjectBehavior
{
    const MIN_SIZE = 230;
    const MAX_SIZE = 74000;
    const INVALID_SIZE = 25;
    const STRING_SIZE = 'fghjfjhgfj';

    function it_must_have_min_size()
    {
        $this->beConstructedWith(
            self::MIN_SIZE,
            self::MAX_SIZE
        );

        $this->getMin()->shouldBe(self::MIN_SIZE);
    }

    function it_must_have_max_size()
    {
        $this->beConstructedWith(
            self::MIN_SIZE,
            self::MAX_SIZE
        );

        $this->getMax()->shouldBe(self::MAX_SIZE);
    }

    function it_must_thrown_an_exception_when_min_is_not_an_integer()
    {
        $this->beConstructedWith(
            self::STRING_SIZE,
            self::MAX_SIZE
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

    function it_must_thrown_an_exception_when_max_is_not_an_integer()
    {
        $this->beConstructedWith(
            self::MIN_SIZE,
            self::STRING_SIZE
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        );
    }

}
