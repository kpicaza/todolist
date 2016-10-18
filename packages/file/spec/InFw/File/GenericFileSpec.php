<?php

namespace spec\InFw\File;

use InFw\File\BaseMimeType;
use InFw\Size\BaseSize;
use InFw\File\MimeTypes;
use InFw\Range\BaseRange;
use PhpSpec\ObjectBehavior;

class GenericFileSpec extends ObjectBehavior
{
    const SIZE = 340000;
    const NAME = 'my.pdf';
    const TMP_NAME = '/../../../../../web/assets/img/fsf-logo.jpg';
    const INVALID_MIME_TYPE = 'application/pdf';
    const MIME_TYPE = 'image/jpeg';
    const MIN_SIZE = 230;
    const MAX_SIZE = 740000;

    const FILE = [
        'name' => self::NAME,
        'mimeType' => self::MIME_TYPE,
        'size' => self::SIZE
    ];

    protected $size;

    protected $mime;

    function let()
    {
        $this->mime = new BaseMimeType(
            self::MIME_TYPE,
            MimeTypes::IMAGES
        );

        $this->size = new BaseSize(
            self::SIZE,
            new BaseRange(
                self::MIN_SIZE,
                self::MAX_SIZE
            )
        );
    }

    function it_should_have_size()
    {
        $this->beConstructedWith(
            self::NAME,
            $this->mime,
            $this->size,
            __DIR__ . self::TMP_NAME
        );

        $this->getSize()->shouldBe(self::SIZE);
    }

    function it_should_have_name()
    {
        $this->beConstructedWith(
            self::NAME,
            $this->mime,
            $this->size,
            __DIR__ . self::TMP_NAME
        );

        $this->getName()->shouldBe(self::NAME);
    }

    function it_should_have_tmp_name()
    {
        $this->beConstructedWith(
            self::NAME,
            $this->mime,
            $this->size,
            __DIR__ . self::TMP_NAME
        );

        $this->getTmpName()->shouldBe(__DIR__ . self::TMP_NAME);
    }

    function it_should_have_mime_type()
    {
        $this->beConstructedWith(
            self::NAME,
            $this->mime,
            $this->size,
            __DIR__ . self::TMP_NAME
        );

        $this->getMimeType()->shouldBe(self::MIME_TYPE);
    }

    function it_should_thrown_exception_when_file_does_not_exist()
    {
        $this->beConstructedWith(
            self::NAME,
            $this->mime,
            $this->size,
            'fake/dir/file'
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

    function it_should_be_json_serializable()
    {
        $this->beConstructedWith(
            self::NAME,
            $this->mime,
            $this->size,
            __DIR__ . self::TMP_NAME
        );

        $this->jsonSerialize()->shouldBe(self::FILE);
    }

    function it_should_thrown_exception_when_tmp_file_mime_and_given_mime_type_dont_match()
    {
        $mime = new BaseMimeType(
            self::INVALID_MIME_TYPE,
            MimeTypes::PDFS
        );

        $this->beConstructedWith(
            self::NAME,
            $mime,
            $this->size,
            __DIR__ . self::TMP_NAME
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }
}
