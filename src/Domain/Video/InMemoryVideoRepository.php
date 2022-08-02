<?php

namespace Alura\Calisthenics\Domain\Video;

use Alura\Calisthenics\Domain\Student\Student;
use Ds\{Sequence, Vector};

class InMemoryVideoRepository implements VideoRepository
{
    function __construct(
        private Sequence $videos = new Vector()
    ) {}

    public function add(Video $video): self
    {
        $this->videos->push($video);
        return $this;
    }

    public function videosFor(Student $student): Sequence
    {
        return $this->videos->filter(
            fn ($video) => $video->ageLimit <= $student->age()
        );
    }
}
