<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"student"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"module", "student"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups({"module", "student"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups({"module", "student"})
     */
    private $Surname;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="students")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"module", "student"})
     */
    private $module_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mark", mappedBy="markform_id")
     * @Groups("student")
     */
    private $marks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attendance", mappedBy="student_id")
     * @Groups("student")
     */
    private $attendances;

    public function __construct()
    {
        $this->marks = new ArrayCollection();
        $this->attendances = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    public function setSurname(string $Surname): self
    {
        $this->Surname = $Surname;

        return $this;
    }

    public function getModuleId(): ?Module
    {
        return $this->module_id;
    }

    public function setModuleId(?Module $module_id): self
    {
        $this->module_id = $module_id;

        return $this;
    }

    /**
     * @return Collection|Mark[]
     */
    public function getMarks(): Collection
    {
        return $this->marks;
    }

    public function addMark(Mark $mark): self
    {
        if (!$this->marks->contains($mark)) {
            $this->marks[] = $mark;
            $mark->setMarkformId($this);
        }

        return $this;
    }

    public function removeMark(Mark $mark): self
    {
        if ($this->marks->contains($mark)) {
            $this->marks->removeElement($mark);
            // set the owning side to null (unless already changed)
            if ($mark->getMarkformId() === $this) {
                $mark->setMarkformId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Attendance[]
     */
    public function getAttendances(): Collection
    {
        return $this->attendances;
    }

    public function addAttendance(Attendance $attendance): self
    {
        if (!$this->attendances->contains($attendance)) {
            $this->attendances[] = $attendance;
            $attendance->setStudentId($this);
        }

        return $this;
    }

    public function removeAttendance(Attendance $attendance): self
    {
        if ($this->attendances->contains($attendance)) {
            $this->attendances->removeElement($attendance);
            // set the owning side to null (unless already changed)
            if ($attendance->getStudentId() === $this) {
                $attendance->setStudentId(null);
            }
        }

        return $this;
    }
}
