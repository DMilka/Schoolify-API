<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AttendanceFormRepository")
 */
class AttendanceForm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("module")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups("module")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="attendanceForms")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("module")
     */
    private $moduleId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attendance", mappedBy="attendanceFormId")
     */
    private $attendances;

    public function __construct()
    {
        $this->attendances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
            $attendance->setAttendanceFormId($this);
        }

        return $this;
    }

    public function removeAttendance(Attendance $attendance): self
    {
        if ($this->attendances->contains($attendance)) {
            $this->attendances->removeElement($attendance);
            // set the owning side to null (unless already changed)
            if ($attendance->getAttendanceFormId() === $this) {
                $attendance->setAttendanceFormId(null);
            }
        }

        return $this;
    }
}
