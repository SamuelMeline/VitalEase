<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
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

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    // Nous allons ajouter des propriétés à notre entité Users pour stocker les données d'activité physique. Ces propriétés pourraient inclure des champs tels que dailySteps, caloriesBurned, exerciseTime, etc.

    #[ORM\Column(type: 'integer', nullable: true)]
    private $dailySteps;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $caloriesBurned;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $exerciseTime;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $sleepTime;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $nutrition;

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
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

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

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getDailySteps(): ?int
    {
        return $this->dailySteps;
    }

    public function setDailySteps(?int $dailySteps): self
    {
        $this->dailySteps = $dailySteps;

        return $this;
    }

    public function getCaloriesBurned(): ?int
    {
        return $this->caloriesBurned;
    }

    public function setCaloriesBurned(?int $caloriesBurned): self
    {
        $this->caloriesBurned = $caloriesBurned;

        return $this;
    }

    public function getExerciseTime(): ?int
    {
        return $this->exerciseTime;
    }

    public function setExerciseTime(?int $exerciseTime): self
    {
        $this->exerciseTime = $exerciseTime;

        return $this;
    }

    public function getSleepTime(): ?int
    {
        return $this->sleepTime;
    }

    public function setSleepTime(?int $sleepTime): self
    {
        $this->sleepTime = $sleepTime;

        return $this;
    }

    public function getNutrition(): ?int
    {
        return $this->nutrition;
    }

    public function setNutrition(?int $nutrition): self
    {
        $this->nutrition = $nutrition;

        return $this;
    }
}
