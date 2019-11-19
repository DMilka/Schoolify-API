<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\MarkFormRepository")
 * @ApiFilter(SearchFilter::class, properties={"moduleId": "exact"})
 * 
 */
class MarkForm
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
     * @ORM\Column(type="float", nullable=true)
     * @Groups("module")
     */
    private $avgValue;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Module", inversedBy="markForm", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups("module")
     */
    private $moduleId;

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

    public function getAvgValue(): ?float
    {
        return $this->avgValue;
    }

    public function setAvgValue(?float $avgValue): self
    {
        $this->avgValue = $avgValue;

        return $this;
    }

    public function getModuleId(): ?Module
    {
        return $this->moduleId;
    }

    public function setModuleId(Module $moduleId): self
    {
        $this->moduleId = $moduleId;

        return $this;
    }
}
