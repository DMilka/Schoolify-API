<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"module"}}
 * })
 * )
 * @ApiFilter(SearchFilter::class, properties={"teacher_id": "exact"})
 * @ORM\Entity(repositoryClass="App\Repository\ModuleRepository")
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
     * @ORM\OneToMany(targetEntity="App\Entity\Student", mappedBy="module_id")
     * @Groups("module")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MarkForm", mappedBy="module_id")
     * @Groups("module")
     */
    private $markForms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AttendanceForm", mappedBy="module_id")
     * @Groups("module")
     */
    private $attendanceForms;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AverageType", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("module")
     */
    private $averageTypeId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Teacher",  inversedBy="teachers")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("module")
     */
    private $teacherId;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("module")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("module")
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("module")
     */
    private $className;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->markForms = new ArrayCollection();
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
     * @return Collection|MarkForm[]
     */
    public function getMarkForms(): Collection
    {
        return $this->markForms;
    }

    public function addMarkForm(MarkForm $markForm): self
    {
        if (!$this->markForms->contains($markForm)) {
            $this->markForms[] = $markForm;
            $markForm->setModuleId($this);
        }

        return $this;
    }

    public function removeMarkForm(MarkForm $markForm): self
    {
        if ($this->markForms->contains($markForm)) {
            $this->markForms->removeElement($markForm);
            // set the owning side to null (unless already changed)
            if ($markForm->getModuleId() === $this) {
                $markForm->setModuleId(null);
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

    public function setAverageTypeId(AverageType $averageTypeId): self
    {
        $this->averageTypeId = $averageTypeId;

        return $this;
    }

    public function getTeacherId(): ?Teacher
    {
        return $this->teacherId;
    }

    public function setTeacherId(Teacher $teacherId): self
    {
        $this->teacherId = $teacherId;

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

    public function getClassName(): ?string
    {
        return $this->className;
    }

    public function setClassName(string $className): self
    {
        $this->className = $className;

        return $this;
    }


}
