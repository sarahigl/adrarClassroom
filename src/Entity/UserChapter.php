<?php

namespace App\Entity;

use App\Repository\UserChapterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserChapterRepository::class)]
class UserChapter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $user_chapter_signup_date = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $user_chapter_ended = null;

    #[ORM\ManyToOne(inversedBy: 'userChapters')]
    private ?User $id_user = null;

    /**
     * @var Collection<int, Chapter>
     */
    #[ORM\ManyToMany(targetEntity: Chapter::class, inversedBy: 'userChapters')]
    private Collection $id_chapter;

    public function __construct()
    {
        $this->id_chapter = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserChapterSignupDate(): ?\DateTimeInterface
    {
        return $this->user_chapter_signup_date;
    }

    public function setUserChapterSignupDate(\DateTimeInterface $user_chapter_signup_date): static
    {
        $this->user_chapter_signup_date = $user_chapter_signup_date;

        return $this;
    }

    public function getUserChapterEnded(): ?int
    {
        return $this->user_chapter_ended;
    }

    public function setUserChapterEnded(int $user_chapter_ended): static
    {
        $this->user_chapter_ended = $user_chapter_ended;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return Collection<int, Chapter>
     */
    public function getIdChapter(): Collection
    {
        return $this->id_chapter;
    }

    public function addIdChapter(Chapter $idChapter): static
    {
        if (!$this->id_chapter->contains($idChapter)) {
            $this->id_chapter->add($idChapter);
        }

        return $this;
    }

    public function removeIdChapter(Chapter $idChapter): static
    {
        $this->id_chapter->removeElement($idChapter);

        return $this;
    }
}
