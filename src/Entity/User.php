<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $user_name = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $lastname_user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $user_image = null;

    /**
     * @var Collection<int, UserChapter>
     */
    #[ORM\OneToMany(targetEntity: UserChapter::class, mappedBy: 'id_user')]
    private Collection $userChapters;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'id_user')]
    private Collection $reviews;

    public function __construct()
    {
        $this->userChapters = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {

        $this->password = password_hash( $password,PASSWORD_BCRYPT);
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(?string $user_name): static
    {
        $this->user_name = $user_name;

        return $this;
    }

    public function getLastnameUser(): ?string
    {
        return $this->lastname_user;
    }

    public function setLastnameUser(?string $lastname_user): static
    {
        $this->lastname_user = $lastname_user;

        return $this;
    }

    public function getUserImage(): ?string
    {
        return $this->user_image;
    }

    public function setUserImage(?string $user_image): static
    {
        $this->user_image = $user_image;

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
            $userChapter->setIdUser($this);
        }

        return $this;
    }

    public function removeUserChapter(UserChapter $userChapter): static
    {
        if ($this->userChapters->removeElement($userChapter)) {
            // set the owning side to null (unless already changed)
            if ($userChapter->getIdUser() === $this) {
                $userChapter->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setIdUser($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getIdUser() === $this) {
                $review->setIdUser(null);
            }
        }

        return $this;
    }
    public function __tostring(){
        return $this->getUserName();
    }

}
