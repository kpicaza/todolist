<?php

namespace spec\InFw\File;

use InFw\File\Size;
use PhpSpec\ObjectBehavior;

class GenericFileSpec extends ObjectBehavior
{
    const SIZE = 340000;
    const NAME = 'my.pdf';
    const TMP_NAME = '/tmp/aDKsSvf';
    const MIME_TYPE = 'application/pdf';
    const MIN_SIZE = 230;
    const MAX_SIZE = 740000;

    const FILE = [
        'name' => self::NAME,
        'mimeType' => self::MIME_TYPE,
        'size' => self::SIZE
    ];

    protected $size;

    function let()
    {
        $this->size = new Size(
            self::SIZE,
            self::MIN_SIZE,
            self::MAX_SIZE
        );
    }

    function it_should_have_size()
    {
        $this->beConstructedWith(
            self::NAME,
            self::MIME_TYPE,
            $this->size,
            self::TMP_NAME
        );

        $this->getSize()->shouldBe(self::SIZE);
    }

    function it_should_have_name()
    {
        $this->beConstructedWith(
            self::NAME,
            self::MIME_TYPE,
            $this->size,
            self::TMP_NAME
        );

        $this->getName()->shouldBe(self::NAME);
    }

    function it_should_have_tmp_name()
    {
        $this->beConstructedWith(
            self::NAME,
            self::MIME_TYPE,
            $this->size,
            self::TMP_NAME
        );

        $this->getTmpName()->shouldBe(self::TMP_NAME);
    }

    function it_should_have_mime_type()
    {
        $this->beConstructedWith(
            self::NAME,
            self::MIME_TYPE,
            $this->size,
            self::TMP_NAME
        );

        $this->getMimeType()->shouldBe(self::MIME_TYPE);
    }

    function it_should_be_json_serializable()
    {
        $this->beConstructedWith(
            self::NAME,
            self::MIME_TYPE,
            $this->size,
            self::TMP_NAME
        );

        $this->jsonSerialize()->shouldBe(self::FILE);
    }
}
