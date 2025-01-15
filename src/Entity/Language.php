<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $language_label = null;

    /**
     * @var Collection<int, Course>
     */
    #[ORM\OneToMany(targetEntity: Course::class, mappedBy: 'id_language')]
    private Collection $courses;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLanguageLabel(): ?string
    {
        return $this->language_label;
    }

    public function setLanguageLabel(string $language_label): static
    {
        $this->language_label = $language_label;

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getIdLevel(): Collection
    {
        return $this->courses;
    }

    public function addIdLevel(Course $idLevel): static
    {
        if (!$this->courses->contains($idLevel)) {
            $this->courses->add($idLevel);
            $idLevel->setIdLanguage($this);
        }

        return $this;
    }

    public function removeIdLevel(Course $idLevel): static
    {
        if ($this->courses->removeElement($idLevel)) {
            // set the owning side to null (unless already changed)
            if ($idLevel->getIdLanguage() === $this) {
                $idLevel->setIdLanguage(null);
            }
        }

        return $this;
    }
    public function __tostring(){
        return $this->getLanguageLabel();
    }
}
