<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MarkRepository")
 */
class Mark
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("student")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("student")
     */
    private $value;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("student")
     */
    private $oldValue;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MarkForm")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("student")
     */
    private $markformId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="marks")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("student")
     */
    private $studentId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getOldValue(): ?float
    {
        return $this->oldValue;
    }

    public function setOldValue(?float $oldValue): self
    {
        $this->oldValue = $oldValue;

        return $this;
    }

    public function getMarkformId(): ?MarkForm
    {
        return $this->markformId;
    }

    public function setMarkformId(?MarkForm $markformId): self
    {
        $this->markformId = $markformId;

        return $this;
    }

    public function getStudentId(): ?Student
    {
        return $this->studentId;
    }

    public function setStudentId(?Student $studentId): self
    {
        $this->studentId = $studentId;

        return $this;
    }
}
