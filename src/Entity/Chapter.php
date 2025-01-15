<?php

namespace App\Entity;

use App\Repository\ChapterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChapterRepository::class)]
class Chapter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $chapter_title = null;

    #[ORM\Column]
    private ?int $chapter_position = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $chapter_content = null;

    /**
     * @var Collection<int, UserChapter>
     */
    #[ORM\ManyToMany(targetEntity: UserChapter::class, mappedBy: 'id_chapter')]
    private Collection $userChapters;

    /**
     * @var Collection<int, Course>
     */
    #[ORM\OneToMany(targetEntity: Course::class, mappedBy: 'chapter')]
    private Collection $id_course;

    public function __construct()
    {
        $this->userChapters = new ArrayCollection();
        $this->id_course = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChapterTitle(): ?string
    {
        return $this->chapter_title;
    }

    public function setChapterTitle(string $chapter_title): static
    {
        $this->chapter_title = $chapter_title;

        return $this;
    }

    public function getChapterPosition(): ?int
    {
        return $this->chapter_position;
    }

    public function setChapterPosition(int $chapter_position): static
    {
        $this->chapter_position = $chapter_position;

        return $this;
    }

    public function getChapterContent(): ?string
    {
        return $this->chapter_content;
    }

    public function setChapterContent(string $chapter_content): static
    {
        $this->chapter_content = $chapter_content;

        return $this;
    }

    /**
     * @return Collection<int, UserChapter>
     */
    public function getUserChapters(): Collection
    {
        return $this->userChapters;
    }

    public function addUserChapter(UserChapter $userChapter): static
    {
        if (!$this->userChapters->contains($userChapter)) {
            $this->userChapters->add($userChapter);
            $userChapter->addIdChapter($this);
        }

        return $this;
    }

    public function removeUserChapter(UserChapter $userChapter): static
    {
        if ($this->userChapters->removeElement($userChapter)) {
            $userChapter->removeIdChapter($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getIdCourse(): Collection
    {
        return $this->id_course;
    }

    public function addIdCourse(Course $idCourse): static
    {
        if (!$this->id_course->contains($idCourse)) {
            $this->id_course->add($idCourse);
            $idCourse->setChapter($this);
        }

        return $this;
    }

    public function removeIdCourse(Course $idCourse): static
    {
        if ($this->id_course->removeElement($idCourse)) {
            // set the owning side to null (unless already changed)
            if ($idCourse->getChapter() === $this) {
                $idCourse->setChapter(null);
            }
        }

        return $this;
    }
    public function __tostring(){
        return $this->getChapterTitle();
    }
    public function getByPosition(){
        return $this->getChapterPosition();
    }


}
