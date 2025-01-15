<?php

namespace App\Entity;
use App\Entity\Level;
use App\Repository\CourseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $course_title = null;

    #[ORM\Column(length: 100)]
    private ?string $course_synopsis = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $course_level = null;

    #[ORM\Column]
    private ?int $course_estimation_time = null;

    #[ORM\Column(length: 100)]
    private ?string $course_img = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $course_date = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $courses_created = null;

    #[ORM\ManyToOne(inversedBy: 'id_course')]
    private ?Chapter $chapter = null;

    #[ORM\ManyToOne(inversedBy: 'id_level')]
    private ?Language $id_language = null;

    #[ORM\ManyToOne]
    private ?level $id_level = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourseTitle(): ?string
    {
        return $this->course_title;
    }

    public function setCourseTitle(string $course_title): static
    {
        $this->course_title = $course_title;

        return $this;
    }

    public function getCourseSynopsis(): ?string
    {
        return $this->course_synopsis;
    }

    public function setCourseSynopsis(string $course_synopsis): static
    {
        $this->course_synopsis = $course_synopsis;

        return $this;
    }

    public function getCourseLevel(): ?int
    {
        return $this->course_level;
    }

    public function setCourseLevel(int $course_level): static
    {
        $this->course_level = $course_level;

        return $this;
    }

    public function getCourseEstimationTime(): ?int
    {
        return $this->course_estimation_time;
    }

    public function setCourseEstimationTime(int $course_estimation_time): static
    {
        $this->course_estimation_time = $course_estimation_time;

        return $this;
    }

    public function getCourseImg(): ?string
    {
        return $this->course_img;
    }

    public function setCourseImg(string $course_img): static
    {
        $this->course_img = $course_img;

        return $this;
    }

    public function getCourseDate(): ?\DateTimeInterface
    {
        return $this->course_date;
    }

    public function setCourseDate(\DateTimeInterface $course_date): static
    {
        $this->course_date = $course_date;

        return $this;
    }

    public function getCoursesCreated(): ?int
    {
        return $this->courses_created;
    }

    public function setCoursesCreated(int $courses_created): static
    {
        $this->courses_created = $courses_created;

        return $this;
    }

    public function getChapter(): ?Chapter
    {
        return $this->chapter;
    }

    public function setChapter(?Chapter $chapter): static
    {
        $this->chapter = $chapter;

        return $this;
    }
    public function getChapterName(){
        return $this->getChapter()? $this->getChapter()->getChapterTitle() : 'No Chapter';
    }

    public function getIdLanguage(): ?Language
    {
        return $this->id_language;
    }

    public function setIdLanguage(?Language $id_language): static
    {
        $this->id_language = $id_language;

        return $this;
    }

    public function getIdLevel(): ?level
    {
        return $this->id_level;
    }

    public function setIdLevel(?level $id_level): static
    {
        $this->id_level = $id_level;

        return $this;
    }
    /* public function __tostring(){
        return (string) $this->getCourseEstimationTime();
    } */
}
