<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AttendanceRepository")
 */
class Attendance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("student")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("student")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AttendanceForm", inversedBy="attendances")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("student")
     */
    private $attendance_form_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="attendances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?bool
    {
        return $this->value;
    }

    public function setValue(bool $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getAttendanceFormId(): ?AttendanceForm
    {
        return $this->attendance_form_id;
    }

    public function setAttendanceFormId(?AttendanceForm $attendance_form_id): self
    {
        $this->attendance_form_id = $attendance_form_id;

        return $this;
    }

    public function getStudentId(): ?Student
    {
        return $this->student_id;
    }

    public function setStudentId(?Student $student_id): self
    {
        $this->student_id = $student_id;

        return $this;
    }
}
