<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"module"}}
 * )
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
     * @ORM\OneToOne(targetEntity="App\Entity\Teacher", inversedBy="module", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("module")
     */
    private $teacher_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AverageType", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("module")
     */
    private $average_type_id;

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

    public function getTeacherId(): ?Teacher
    {
        return $this->teacher_id;
    }

    public function setTeacherId(Teacher $teacher_id): self
    {
        $this->teacher_id = $teacher_id;

        return $this;
    }

    public function getAverageTypeId(): ?AverageType
    {
        return $this->average_type_id;
    }

    public function setAverageTypeId(AverageType $average_type_id): self
    {
        $this->average_type_id = $average_type_id;

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
}
