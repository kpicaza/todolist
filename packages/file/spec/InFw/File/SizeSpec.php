<?php

namespace spec\InFw\File;

use InFw\File\Size;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SizeSpec extends ObjectBehavior
{
    const SIZE = 14048;
    const MIN_SIZE = 230;
    const MAX_SIZE = 74000;
    const INVALID_SIZE = 25;
    const STRING_SIZE = 'fghjfjhgfj';

    function it_must_have_size_between_max_and_min_sizes()
    {
        $this->beConstructedWith(
            self::SIZE,
            self::MIN_SIZE,
            self::MAX_SIZE
        );

        $this->get()->shouldBe(self::SIZE);
    }

    function it_must_have_min_size()
    {
        $this->beConstructedWith(
            self::SIZE,
            self::MIN_SIZE,
            self::MAX_SIZE
        );

        $this->getMin()->shouldBe(self::MIN_SIZE);
    }

    function it_must_have_max_size()
    {
        $this->beConstructedWith(
            self::SIZE,
            self::MIN_SIZE,
            self::MAX_SIZE
        );

        $this->getMax()->shouldBe(self::MAX_SIZE);
    }

    function it_must_thrown_an_exception_when_file_size_is_not_valid()
    {
        $this->beConstructedWith(
            self::INVALID_SIZE,
            self::MIN_SIZE,
            self::MAX_SIZE
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

    function it_must_thrown_an_exception_when_file_size_is_not_an_integer()
    {
        $this->beConstructedWith(
            self::STRING_SIZE,
            self::MIN_SIZE,
            self::MAX_SIZE
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

    function it_must_thrown_an_exception_when_file_min_size_not_an_integer()
    {
        $this->beConstructedWith(
            self::SIZE,
            self::STRING_SIZE,
            self::MAX_SIZE
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

    function it_must_thrown_an_exception_when_file_max_size_not_an_integer()
    {
        $this->beConstructedWith(
            self::SIZE,
            self::MIN_SIZE,
            self::STRING_SIZE
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        );
    }
}
