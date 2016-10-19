<?php

namespace spec\InFw\FileManager;

use InFw\File\File;
use InFw\File\BaseMimeTypeFactory;
use InFw\File\GenericFile;
use InFw\File\MimeTypes;
use InFw\Size\BaseSizeFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Prophet;

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

        $realFilePath = self::ROOT_FOLDER . $this->file->getName();
        if (file_exists($realFilePath)) {
            unlink($realFilePath);
        }
    }

    function it_can_add_sub_paths_to_root_folder()
    {
        $this->beConstructedWith(
            self::ROOT_FOLDER
        );

        $this->addSubFolder(self::SUB_FOLDER);

        $this->getFolder()->shouldBe(self::ROOT_FOLDER.self::SUB_FOLDER);
    }

    function it_should_thrown_an_exception_when_sub_folder_not_exist()
    {
        $this->beConstructedWith(
            self::ROOT_FOLDER
        );

        $this->addSubFolder('some/fake/path/');

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->during('addSubFolder', ['some/fake/path/']);
    }

    function it_should_thrown_an_exception_when_root_folder_not_exist()
    {
        $this->beConstructedWith(
            '/some/fake/path'
        );

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->duringInstantiation();
    }

    function it_should_throw_an_exception_when_it_cannot_persist_file_on_a_filestem()
    {
        $file = (new Prophet())->prophesize(File::class);
        $file->getName()->willReturn(self::NAME);
        $file->getTmpName()->willReturn(self::TMP_NAME.'fakefake');

        if (!is_dir('/tmp/fake/')) {
            mkdir('/tmp/fake/');
        }

        $this->beConstructedWith(
            self::ROOT_FOLDER
        );

        $this->addSubFolder('fake/');

        if (file_exists('/tmp/fake/')) {
            rmdir('/tmp/fake/');
        }

        $this->shouldThrow(
            \InvalidArgumentException::class
        )->during('save', [$file]);
    }

}
