<?php

namespace Alura\Calisthenics\Tests\Unit\Domain\Video;

use Alura\Calisthenics\Domain\Video\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    public function testMakingAVideoPublicMustWork()
    {
        $video = new Video(16);
        $video->publish();

        self::assertTrue($video->isPublic());
    }
}
