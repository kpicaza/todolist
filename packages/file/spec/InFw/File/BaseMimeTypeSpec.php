<?php

namespace spec\InFw\File;

use InFw\File\MimeTypes;
use PhpSpec\ObjectBehavior;

class BaseMimeTypeSpec extends ObjectBehavior
{
    const IMAGE_MIME = 'image/jpeg';
    const IMAGE_PATH = '/../../../../../web/assets/img/fsf-logo.jpg';
    const GROUP = 'IMAGES';

    function it_can_validate_mime_type_staticaly()
    {
        $this->beConstructedWith(
            self::IMAGE_MIME, MimeTypes::IMAGES
        );

        $this::isValid(__DIR__ . self::IMAGE_PATH, MimeTypes::IMAGES)->shouldReturn(true);

    }

    function it_shoud_return_false_if_mime_is_not_valid()
    {
        $this->beConstructedWith(
            self::IMAGE_MIME, MimeTypes::IMAGES
        );

        $this::isValid(__DIR__ . self::IMAGE_PATH, MimeTypes::AUDIOS)->shouldReturn(false);
    }

    function it_should_have_mime_type()
    {
        $this->beConstructedWith(
            self::IMAGE_MIME, MimeTypes::IMAGES
        );

        $this->get()->shouldBe(self::IMAGE_MIME);
    }

    function it_should_thrown_exception_when_mime_type_is_not_valid()
    {
        $this->beConstructedWith(
            'fake/mime-type', MimeTypes::IMAGES
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

    function it_should_thrown_exception_when_valid_mime_types_array_is_not_valid()
    {
        $this->beConstructedWith(
            self::IMAGE_MIME, ['fake/mime-type']
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }
}
