<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SkillRepository")
 */
class Skill
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PersonalSkill", mappedBy="skillId", orphanRemoval=true)
     */
    private $personalSkills;

    public function __construct()
    {
        $this->personalSkills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $personalSkill->setSkillId($this);
        }

        return $this;
    }

    public function removePersonalSkill(PersonalSkill $personalSkill): self
    {
        if ($this->personalSkills->contains($personalSkill)) {
            $this->personalSkills->removeElement($personalSkill);
            // set the owning side to null (unless already changed)
            if ($personalSkill->getSkillId() === $this) {
                $personalSkill->setSkillId(null);
            }
        }

        return $this;
    }
}
