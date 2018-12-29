<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LabDayTeamRepository")
 */
class LabDayTeam
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="labDayTeam")
     */
    private $users;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\LabDay", inversedBy="labDayTeam", cascade={"persist", "remove"})
     */
    private $labDay;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setLabDayTeam($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getLabDayTeam() === $this) {
                $user->setLabDayTeam(null);
            }
        }

        return $this;
    }

    public function getLabDay(): ?LabDay
    {
        return $this->labDay;
    }

    public function setLabDay(?LabDay $labDay): self
    {
        $this->labDay = $labDay;

        return $this;
    }
}
