<?php

namespace Alura\Calisthenics\Tests\Unit\Domain\Student;

use Alura\Calisthenics\Domain\Address\Address;
use Alura\Calisthenics\Domain\Email\EmailAddress;
use Alura\Calisthenics\Domain\Student\FullName;
use Alura\Calisthenics\Domain\Student\Student;
use Alura\Calisthenics\Domain\Video\Video;
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    private Student $student;

    protected function setUp(): void
    {
        $this->student = new Student(
            new EmailAddress('email@example.com'),
            new \DateTimeImmutable('1997-10-15'),
            new FullName('Caio', 'Corrêa Chaves'),
            new Address(
                'Rua de Exemplo',
                '71B',
                'Meu Bairro',
                'Minha Cidade',
                'Meu estado',
                'Brasil',
                '06655500'
            )
        );
    }

    public function testStudentWithoutWatchedVideosHasAccess()
    {
        self::assertTrue($this->student->hasAccess());
    }

    public function testStudentWithFirstWatchedVideoInLessThan90DaysHasAccess()
    {
        $date = new \DateTimeImmutable('89 days');
        $this->student->watch(new Video(16), $date);

        self::assertTrue($this->student->hasAccess());
    }

    public function testStudentWithFirstWatchedVideoInLessThan90DaysButOtherVideosWatchedHasAccess()
    {
        $this->student->watch(new Video(16), new \DateTimeImmutable('-89 days'));
        $this->student->watch(new Video(16), new \DateTimeImmutable('-60 days'));
        $this->student->watch(new Video(16), new \DateTimeImmutable('-30 days'));

        self::assertTrue($this->student->hasAccess());
    }

    public function testStudentWithFirstWatchedVideoIn90DaysDoesntHaveAccess()
    {
        $date = new \DateTimeImmutable('-90 days');
        $this->student->watch(new Video(16), $date);

        self::assertFalse($this->student->hasAccess());
    }

    public function testStudentWithFirstWatchedVideoIn90DaysButOtherVideosWatchedDoesntHaveAccess()
    {
        $this->student->watch(new Video(16), new \DateTimeImmutable('-90 days'));
        $this->student->watch(new Video(16), new \DateTimeImmutable('-60 days'));
        $this->student->watch(new Video(16), new \DateTimeImmutable('-30 days'));

        self::assertFalse($this->student->hasAccess());
    }
}
