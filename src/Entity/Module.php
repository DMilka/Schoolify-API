<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"module"}, "enable_max_depth"=true  },
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
 * @ApiFilter(SearchFilter::class, properties={"teacherId": "exact"})
 */
class Module
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("module")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("module")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("module")
     */
    private $className;

    /**
     * @ORM\Column(type="date")
     * @Groups("module")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("module")
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Teacher", inversedBy="modules")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("module")
     */
    private $teacherId;



    /**
     * @ORM\OneToOne(targetEntity="App\Entity\MarkForm", mappedBy="moduleId", cascade={"persist", "remove"})
     * @Groups("module")
     * @MaxDepth(2)
     */
    private $markForm;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Student", mappedBy="moduleId")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AttendanceForm", mappedBy="moduleId")
     * @Groups("module")
     * @MaxDepth(2)
     */
    private $attendanceForms;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AverageType")
     * @ORM\JoinColumn(nullable=false)
     *  @Groups("module")
     */
    private $averageTypeId;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->attendanceForms = new ArrayCollection();
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

    public function getClassName(): ?string
    {
        return $this->className;
    }

    public function setClassName(string $className): self
    {
        $this->className = $className;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getTeacherId(): ?Teacher
    {
        return $this->teacherId;
    }

    public function setTeacherId(?Teacher $teacherId): self
    {
        $this->teacherId = $teacherId;

        return $this;
    }



    public function getMarkForm(): ?MarkForm
    {
        return $this->markForm;
    }

    public function setMarkForm(MarkForm $markForm): self
    {
        $this->markForm = $markForm;

        // set the owning side of the relation if necessary
        if ($markForm->getModuleId() !== $this) {
            $markForm->setModuleId($this);
        }

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setModuleId($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->contains($student)) {
            $this->students->removeElement($student);
            // set the owning side to null (unless already changed)
            if ($student->getModuleId() === $this) {
                $student->setModuleId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AttendanceForm[]
     */
    public function getAttendanceForms(): Collection
    {
        return $this->attendanceForms;
    }

    public function addAttendanceForm(AttendanceForm $attendanceForm): self
    {
        if (!$this->attendanceForms->contains($attendanceForm)) {
            $this->attendanceForms[] = $attendanceForm;
            $attendanceForm->setModuleId($this);
        }

        return $this;
    }

    public function removeAttendanceForm(AttendanceForm $attendanceForm): self
    {
        if ($this->attendanceForms->contains($attendanceForm)) {
            $this->attendanceForms->removeElement($attendanceForm);
            // set the owning side to null (unless already changed)
            if ($attendanceForm->getModuleId() === $this) {
                $attendanceForm->setModuleId(null);
            }
        }

        return $this;
    }

    public function getAverageTypeId(): ?AverageType
    {
        return $this->averageTypeId;
    }

    public function setAverageTypeId(?AverageType $averageTypeId): self
    {
        $this->averageTypeId = $averageTypeId;

        return $this;
    }
}
