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
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups("student")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="attendances")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("student")
     */
    private $studentId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AttendanceForm", inversedBy="attendances")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("student")
     */
    private $attendanceFormId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?bool
    {
        return $this->value;
    }

    public function setValue(?bool $value): self
    {
        $this->value = $value;

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

    public function getAttendanceFormId(): ?AttendanceForm
    {
        return $this->attendanceFormId;
    }

    public function setAttendanceFormId(?AttendanceForm $attendanceFormId): self
    {
        $this->attendanceFormId = $attendanceFormId;

        return $this;
    }
}
