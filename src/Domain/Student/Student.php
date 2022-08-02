<?php

namespace Alura\Calisthenics\Domain\Student;

use Alura\Calisthenics\Domain\Address\Address;
use Alura\Calisthenics\Domain\Email\EmailAddress;
use Alura\Calisthenics\Domain\Video\Video;
use DateTimeInterface;

class Student
{
    private WatchedVideos $watchedVideos;

    public function __construct(
        public readonly EmailAddress $email,
        public readonly DateTimeInterface $birthday,
        public readonly FullName $fullName,
        public readonly Address $address
    ) {
        $this->watchedVideos = new WatchedVideos( new \Ds\Map() );
    }

    public function age(): int
    {
        $today = new \DateTimeImmutable();
        return $today->diff($this->birthday)->y;
    }

    public function watch(Video $video, DateTimeInterface $date)
    {
        $this->watchedVideos->add($video, $date);
    }

    public function hasAccess(): bool
    {
        if ($this->watchedVideos->count() == 0)
            return true;

        $firstDate = $this->watchedVideos->dateOfFirstVideo();
        $today = new \DateTimeImmutable();

        return $firstDate->diff($today)->days < 90;
    }
}
