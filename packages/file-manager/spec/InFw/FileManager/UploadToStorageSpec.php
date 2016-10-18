<?php

namespace spec\InFw\FileManager;

use InFw\File\BaseMimeTypeFactory;
use InFw\File\File;
use InFw\File\GenericFileFactory;
use InFw\File\MimeTypes;
use InFw\FileManager\BasicStorage;
use InFw\Size\BaseSizeFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Prophet;

class UploadToStorageSpec extends ObjectBehavior
{
    const NAME = 'fsf-logo.jpg';
    const TMP_NAME = '/../../../../../web/assets/img/fsf-logo.jpg';
    const MIME_TYPE = 'image/jpeg';
    const MIN_SIZE = 10;
    const MAX_SIZE = 740000;

    private $prophet;
    private $filesystem;
    private $factory;

    function let()
    {
        $this->factory = new GenericFileFactory(
            new BaseMimeTypeFactory(
                MimeTypes::IMAGES
            ),
            new BaseSizeFactory(
                self::MIN_SIZE,
                self::MAX_SIZE
            )
        );

        $this->prophet = new Prophet();

        $this->filesystem = $this->prophet->prophesize(BasicStorage::class);
    }

    function it_can_send_file_to_filesystem_to_persist()
    {
        $this->beConstructedWith(
            $this->filesystem,
            $this->factory
        );

        $this->sendToStorage(__DIR__ . self::TMP_NAME, self::NAME)
            ->shouldBeAnInstanceOf(File::class);
    }
}
