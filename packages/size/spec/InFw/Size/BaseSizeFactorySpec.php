<?php

namespace spec\InFw\Size;

use InFw\Size\BaseSize;
use InFw\Size\Size;
use InFw\Range\BaseRange;
use InFw\Range\Range;
use PhpSpec\ObjectBehavior;

class BaseSizeFactorySpec extends ObjectBehavior
{
    const SIZE = 340000;
    const MIN_SIZE = 230;
    const MAX_SIZE = 740000;

    private $range;

    function let()
    {
        $this->range = new BaseRange(
            self::MIN_SIZE,
            self::MAX_SIZE
        );
    }

    function it_can_create_base_size_objects()
    {
        $this->beConstructedWith(
            self::MIN_SIZE,
            self::MAX_SIZE
        );

        $size = new BaseSize(
            self::SIZE,
            $this->range
        );

        $new = $this->make(self::SIZE);

        $new->shouldBeAnInstanceOf(Size::class);
        $new->get()->shouldBe($size->get());
        $new->getRange()->shouldBeAnInstanceOf(Range::class);
        $new->getRange()->getMin()->shouldBe($size->getRange()->getMin());
        $new->getRange()->getMax()->shouldBe($size->getRange()->getMax());
    }
}
