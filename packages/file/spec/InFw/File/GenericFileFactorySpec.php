<?php

namespace spec\InFw\File;

use InFw\File\BaseMimeTypeFactory;
use InFw\Size\BaseSizeFactory;
use InFw\File\File;
use InFw\File\GenericFile;
use InFw\File\MimeTypes;
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
        $this->mime = new BaseMimeTypeFactory(
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
            $this->mime,
            $this->size
        );

        $file = new GenericFile(
            self::NAME,
            $this->mime->make(
                mime_content_type(self::TMP_NAME)
            ),
            $this->size->make(
                filesize(self::TMP_NAME)
            ),
            self::TMP_NAME
        );

        $new = $this->make(self::NAME, self::TMP_NAME);

        $new->shouldBeAnInstanceOf(File::class);
        $new->getName()->shouldBe($file->getName());
        $new->getMimeType()->shouldBe($file->getMimeType());
        $new->getSize()->shouldBe($file->getSize());
        $new->getTmpName()->shouldBe($file->getTmpName());
    }
}
