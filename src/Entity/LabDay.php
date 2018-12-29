<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LabDayRepository")
 */
class LabDay
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $github;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\LabDayTeam", mappedBy="labDay", cascade={"persist", "remove"})
     */
    private $labDayTeam;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): self
    {
        $this->github = $github;

        return $this;
    }

    public function getLabDayTeam(): ?LabDayTeam
    {
        return $this->labDayTeam;
    }

    public function setLabDayTeam(?LabDayTeam $labDayTeam): self
    {
        $this->labDayTeam = $labDayTeam;

        // set (or unset) the owning side of the relation if necessary
        $newLabDay = $labDayTeam === null ? null : $this;
        if ($newLabDay !== $labDayTeam->getLabDay()) {
            $labDayTeam->setLabDay($newLabDay);
        }

        return $this;
    }
}
