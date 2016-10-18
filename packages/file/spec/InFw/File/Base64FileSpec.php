<?php

namespace spec\InFw\File;

use InFw\File\BaseMimeType;
use InFw\File\FileFactory;
use InFw\File\MimeTypes;
use InFw\Range\BaseRange;
use InFw\Size\BaseSize;
use PhpSpec\ObjectBehavior;

class Base64FileSpec extends ObjectBehavior
{
    const SIZE = 340000;
    const NAME = 'my.jpg';
    const TMP_NAME = '/../../../../../web/assets/img/fsf-logo.jpg';
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

    function it_should_encode_file()
    {
        $data = file_get_contents(__DIR__ . self::TMP_NAME);
        $base64 = 'data:' . $this->mime->get() . ';base64,' . base64_encode($data);

        $this->beConstructedWith(
            self::NAME,
            $this->mime,
            $this->size,
            __DIR__ . self::TMP_NAME
        );

        $this->get()->shouldBe($base64);
    }
}
