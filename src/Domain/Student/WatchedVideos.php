<?php

namespace Alura\Calisthenics\Domain\Student;

use Ds\Map;
use Countable;
use DateTimeImmutable;
use DateTimeInterface;
use Alura\Calisthenics\Domain\Video\Video;

class WatchedVideos implements Countable
{
    function __construct(private Map $videos)
    {
    }

    public function count(): int
    {
        return $this->videos->count();
    }

    public function dateOfFirstVideo(): DateTimeImmutable
    {
        $this->videos->sort();
        return $this->videos->first()->value;
    }

    public function add(Video $video, DateTimeInterface $date)
    {
        $this->videos->put($video, $date);
    }
}
