<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;



/**
 * @ApiResource(
 *      normalizationContext={"groups"={"student"}, "enable_max_depth"=true},
 * )
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 * @ApiFilter(SearchFilter::class, properties={"moduleId": "exact"})
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("student")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     *  @Groups("student")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     *  @Groups("student")
     */
    private $surname;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="students")
     * @ORM\JoinColumn(nullable=false)
     *  @Groups("student")
     */
    private $moduleId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mark", mappedBy="studentId")
     *  @Groups("student")
     * @MaxDepth(2)
     */
    private $marks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attendance", mappedBy="studentId")
     *  @Groups("student")
     * @MaxDepth(2)
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
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getModuleId(): ?Module
    {
        return $this->moduleId;
    }

    public function setModuleId(?Module $moduleId): self
    {
        $this->moduleId = $moduleId;

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
            $mark->setStudentId($this);
        }

        return $this;
    }

    public function removeMark(Mark $mark): self
    {
        if ($this->marks->contains($mark)) {
            $this->marks->removeElement($mark);
            // set the owning side to null (unless already changed)
            if ($mark->getStudentId() === $this) {
                $mark->setStudentId(null);
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
