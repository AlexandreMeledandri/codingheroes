<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields={"email"},
 * message="L'email que vous avez indiqué est déjà utilisé")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=8, minMessage="8 caracteres minimum")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Vous n'avez pas tappé le même mot de passe")
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $personalProject;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PersonalSkill", mappedBy="user", orphanRemoval=true)
     */
    private $personalSkills;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SkillCertificationVote", mappedBy="voter")
     */
    private $skillCertificationVotes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SocialNetwork", mappedBy="user", orphanRemoval=true)
     */
    private $socialNetworks;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LabDayTeam", inversedBy="users")
     */
    private $labDayTeam;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Team", mappedBy="users")
     */
    private $teams;

    public function __construct()
    {
        $this->personalSkills = new ArrayCollection();
        $this->skillCertificationVotes = new ArrayCollection();
        $this->socialNetworks = new ArrayCollection();
        $this->teams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials()
    {

    }

    public function getSalt()
    {

    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPersonalProject(): ?string
    {
        return $this->personalProject;
    }

    public function setPersonalProject(?string $personalProject): self
    {
        $this->personalProject = $personalProject;

        return $this;
    }

    /**
     * @return Collection|PersonalSkill[]
     */
    public function getPersonalSkills(): Collection
    {
        return $this->personalSkills;
    }

    public function addPersonalSkill(PersonalSkill $personalSkill): self
    {
        if (!$this->personalSkills->contains($personalSkill)) {
            $this->personalSkills[] = $personalSkill;
            $personalSkill->setUserId($this);
        }

        return $this;
    }

    public function removePersonalSkill(PersonalSkill $personalSkill): self
    {
        if ($this->personalSkills->contains($personalSkill)) {
            $this->personalSkills->removeElement($personalSkill);
            // set the owning side to null (unless already changed)
            if ($personalSkill->getUserId() === $this) {
                $personalSkill->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SkillCertificationVote[]
     */
    public function getSkillCertificationVotes(): Collection
    {
        return $this->skillCertificationVotes;
    }

    public function addSkillCertificationVote(SkillCertificationVote $skillCertificationVote): self
    {
        if (!$this->skillCertificationVotes->contains($skillCertificationVote)) {
            $this->skillCertificationVotes[] = $skillCertificationVote;
            $skillCertificationVote->addVoter($this);
        }

        return $this;
    }

    public function removeSkillCertificationVote(SkillCertificationVote $skillCertificationVote): self
    {
        if ($this->skillCertificationVotes->contains($skillCertificationVote)) {
            $this->skillCertificationVotes->removeElement($skillCertificationVote);
            $skillCertificationVote->removeVoter($this);
        }

        return $this;
    }

    /**
     * @return Collection|SocialNetwork[]
     */
    public function getSocialNetworks(): Collection
    {
        return $this->socialNetworks;
    }

    public function addSocialNetwork(SocialNetwork $socialNetwork): self
    {
        if (!$this->socialNetworks->contains($socialNetwork)) {
            $this->socialNetworks[] = $socialNetwork;
            $socialNetwork->setUser($this);
        }

        return $this;
    }

    public function removeSocialNetwork(SocialNetwork $socialNetwork): self
    {
        if ($this->socialNetworks->contains($socialNetwork)) {
            $this->socialNetworks->removeElement($socialNetwork);
            // set the owning side to null (unless already changed)
            if ($socialNetwork->getUser() === $this) {
                $socialNetwork->setUser(null);
            }
        }

        return $this;
    }

    public function getLabDayTeam(): ?LabDayTeam
    {
        return $this->labDayTeam;
    }

    public function setLabDayTeam(?LabDayTeam $labDayTeam): self
    {
        $this->labDayTeam = $labDayTeam;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->addUser($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            $team->removeUser($this);
        }

        return $this;
    }
}
