<?php

namespace spec\InFw\FileManager;

use InFw\File\File;
use InFw\File\BaseMimeTypeFactory;
use InFw\File\GenericFile;
use InFw\File\MimeTypes;
use InFw\Size\BaseSizeFactory;
use PhpSpec\ObjectBehavior;

class BasicStorageSpec extends ObjectBehavior
{
    const ROOT_FOLDER = '/tmp/';
    const SUB_FOLDER = 'test-my/';
    const TMP_NAME = __DIR__ . '/../../../../../web/assets/img/fsf-logo.jpg';
    const NAME = 'my.jpg';
    const MIN_SIZE = 10;
    const MAX_SIZE = 740000;

    private $mime;
    private $size;
    private $file;

    function let()
    {
        $this->mime = new BaseMimeTypeFactory(
            MimeTypes::IMAGES
        );

        $this->size = new BaseSizeFactory(
            self::MIN_SIZE,
            self::MAX_SIZE
        );

        $this->file = new GenericFile(
            self::NAME,
            $this->mime->make(
                mime_content_type(self::TMP_NAME)
            ),
            $this->size->make(
                filesize(self::TMP_NAME)
            ),
            self::TMP_NAME
        );

    }

    function it_should_persist_file_in_a_filesystem()
    {
        $this->beConstructedWith(
            self::ROOT_FOLDER
        );

        $new = $this->save($this->file);
        $new->shouldBeAnInstanceOf(File::class);
        $new->getName()->shouldBe($this->file->getName());
        $new->getMimeType()->shouldBe($this->file->getMimeType());
        $new->getSize()->shouldBe($this->file->getSize());
        $new->getTmpName()->shouldBe($this->file->getTmpName());
    }
}
