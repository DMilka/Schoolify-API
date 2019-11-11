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
     * @Groups({"module", "student"})
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"module", "student"})
     */
    private $value;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"module", "student"})
     */
    private $old_value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="marks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MarkForm",  inversedBy="marks_forms")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("student")
     */
    private $markform_id;

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
        return $this->old_value;
    }

    public function setOldValue(?float $old_value): self
    {
        $this->old_value = $old_value;

        return $this;
    }

    public function getStudentId(): ?Student
    {
        return $this->student;
    }

    public function setStudentId(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getMarkformId(): ?MarkForm
    {
        return $this->markform_id;
    }

    public function setMarkformId(MarkForm $markform_id): self
    {
        $this->markform_id = $markform_id;

        return $this;
    }
}
