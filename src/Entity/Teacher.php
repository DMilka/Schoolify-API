<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ApiResource(
 *      normalizationContext={"groups"={"teacher"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"username": "exact"})
 * @ORM\Entity(repositoryClass="App\Repository\TeacherRepository")
 */
class Teacher implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("teacher")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("teacher")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("teacher")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("teacher")
     */
    private $surname;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Module", mappedBy="teacher_id", cascade={"persist", "remove"})
     */
    private $module;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(Module $module): self
    {
        $this->module = $module;

        // set the owning side of the relation if necessary
        if ($module->getTeacherId() !== $this) {
            $module->setTeacherId($this);
        }

        return $this;
    }


    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        return ['role'];
    }

    public function eraseCredentials()
    {
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}
