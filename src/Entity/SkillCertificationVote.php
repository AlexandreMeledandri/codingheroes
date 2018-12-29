<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SkillCertificationVoteRepository")
 */
class SkillCertificationVote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="skillCertificationVotes")
     */
    private $voters;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PersonalSkill", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $certifiedPersonalSkill;

    public function __construct()
    {
        $this->voters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getVoters(): Collection
    {
        return $this->voters;
    }

    public function addVoter(User $voter): self
    {
        if (!$this->voters->contains($voter)) {
            $this->voters[] = $voter;
        }

        return $this;
    }

    public function removeVoter(User $voter): self
    {
        if ($this->voters->contains($voter)) {
            $this->voters->removeElement($voter);
        }

        return $this;
    }

    public function getCertifiedPersonalSkill(): ?PersonalSkill
    {
        return $this->certifiedPersonalSkill;
    }

    public function setCertifiedPersonalSkill(PersonalSkill $certifiedPersonalSkill): self
    {
        $this->certifiedPersonalSkill = $certifiedPersonalSkill;

        return $this;
    }
}
