<?php

namespace App\Entity;

use App\Repository\StudentdetaillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentdetaillRepository::class)
 */
class Studentdetaill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $degree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $result;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numpage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numgeneral;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="studentdetaills")
     */
    private $student;

    /**
     * @ORM\ManyToMany(targetEntity=Course::class, mappedBy="course")
     */
    private $courses;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDegree(): ?string
    {
        return $this->degree;
    }

    public function setDegree(?string $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(?string $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getNumpage(): ?int
    {
        return $this->numpage;
    }

    public function setNumpage(?int $numpage): self
    {
        $this->numpage = $numpage;

        return $this;
    }

    public function getNumgeneral(): ?int
    {
        return $this->numgeneral;
    }

    public function setNumgeneral(?int $numgeneral): self
    {
        $this->numgeneral = $numgeneral;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    /**
     * @return Collection|Course[]
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): self
    {
        if (!$this->courses->contains($course)) {
            $this->courses[] = $course;
            $course->addCourse($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): self
    {
        if ($this->courses->removeElement($course)) {
            $course->removeCourse($this);
        }

        return $this;
    }
}

