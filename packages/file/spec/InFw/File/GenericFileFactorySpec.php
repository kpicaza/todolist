<?php

namespace spec\InFw\File;

use InFw\File\BaseMimeType;
use InFw\File\BaseSize;
use InFw\File\BaseSizeFactory;
use InFw\File\File;
use InFw\File\GenericFile;
use InFw\File\MimeTypes;
use InFw\Range\BaseRange;
use PhpSpec\ObjectBehavior;

class GenericFileFactorySpec extends ObjectBehavior
{
    const SIZE = 340000;
    const NAME = 'my.jpg';
    const TMP_NAME = __DIR__ . '/../../../../../web/assets/img/fsf-logo.jpg';
    const MIME_TYPE = 'image/jpeg';
    const MIN_SIZE = 230;
    const MAX_SIZE = 740000;

    protected $size;

    protected $mime;

    function let()
    {
        $this->mime = new BaseMimeType(
            self::MIME_TYPE,
            MimeTypes::IMAGES
        );

        $this->size = new BaseSizeFactory(
            self::MIN_SIZE,
            self::MAX_SIZE
        );
    }

    function it_can_create_new_file_objects()
    {
        $this->beConstructedWith(
            $this->size,
            MimeTypes::IMAGES
        );

        $file = new GenericFile(
            self::NAME,
            $this->mime,
            $this->size->make(self::SIZE),
            self::TMP_NAME
        );

        $new = $this->make(self::NAME, self::MIME_TYPE, self::SIZE, self::TMP_NAME);

        $new->shouldBeAnInstanceOf(File::class);
        $new->getName()->shouldBe($file->getName());
        $new->getMimeType()->shouldBe($file->getMimeType());
        $new->getSize()->shouldBe($file->getSize());
        $new->getTmpName()->shouldBe($file->getTmpName());
    }
}
