<?php

namespace spec\InFw\File;

use InFw\File\BaseMimeType;
use InFw\File\MimeType;
use InFw\File\MimeTypes;
use PhpSpec\ObjectBehavior;

class BaseMimeTypeFactorySpec extends ObjectBehavior
{
    const MIME_TYPE = 'audio/mpeg3';

    private $validMimes;

    function let()
    {
        $this->validMimes = array_merge(
            MimeTypes::AUDIOS,
            MimeTypes::VIDEOS
        );

    }

    function it_can_create_mime_type_objects()
    {
        $this->beConstructedWith($this->validMimes);

        $mime = new BaseMimeType(
            self::MIME_TYPE,
            $this->validMimes
        );

        $new = $this->make(self::MIME_TYPE);

        $new->shouldBeAnInstanceOf(MimeType::class);
        $new->get()->shouldBe($mime->get());
    }
}
