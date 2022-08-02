<?php

namespace Alura\Calisthenics\Domain\Video;

class Video
{
    private bool $visible = false;

    function __construct(public readonly int $ageLimit) {}

    public function publish(): void
    {
        $this->visible = true;
    }

    public function isPublic(): bool
    {
        return $this->visible;
    }
}
