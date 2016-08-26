<?php

namespace spec\App\Common\Entity;

use App\Common\Entity\ProgressInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProgressSpec extends ObjectBehavior
{
    const DONE = true;
    const UNDONE = false;
    const PROGRESS = 56;

    function it_should_be_marked_as_undone_while_progress_is_not_at_100_percent()
    {
        $this->beConstructedWith(
            self::PROGRESS
        );

        $this->isDone()->shouldBe(self::UNDONE);
    }

    function it_should_be_marked_as_done()
    {
        $this->beConstructedWith(
            100
        );

        $this->isDone()->shouldBe(self::DONE);
    }

    function it_has_progress_counter()
    {
        $this->beConstructedWith(
            self::PROGRESS
        );

        $this->get()->shouldBe(self::PROGRESS);
    }

    function it_cannot_have_non_integer_progress_count()
    {
        $this->beConstructedWith(
            'Im not an integer'
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

    function it_cannot_have_an_integer_greater_than_100()
    {
        $this->beConstructedWith(
            101
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

    function it_cannot_have_an_integer_smaller_than_0()
    {
        $this->beConstructedWith(
            -1
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

}
