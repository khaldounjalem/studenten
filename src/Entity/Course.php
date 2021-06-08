<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=CourseRepository::class)
 * @ORM\Table(name="course", indexes={@ORM\Index(columns={"numcourse"}, flags={"fulltext"})})
 */
class Course
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $namecourse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numcourse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numdetaillcourse;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $day;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $time;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $teacher;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $enddate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numlessons;

    /**
     * @ORM\ManyToMany(targetEntity=Studentdetaill::class, inversedBy="courses")
     */
    private $course;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->course = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamecourse(): ?string
    {
        return $this->namecourse;
    }

    public function setNamecourse(string $namecourse): self
    {
        $this->namecourse = $namecourse;

        return $this;
    }

    public function getNumcourse(): ?string
    {
        return $this->numcourse;
    }

    public function setNumcourse(?string $numcourse): self
    {
        $this->numcourse = $numcourse;

        return $this;
    }

    public function getNumdetaillcourse(): ?int
    {
        return $this->numdetaillcourse;
    }

    public function setNumdetaillcourse(int $numdetaillcourse): self
    {
        $this->numdetaillcourse = $numdetaillcourse;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(?\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(?string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(?\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getTeacher(): ?string
    {
        return $this->teacher;
    }

    public function setTeacher(?string $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setEnddate(?\DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function getNumlessons(): ?int
    {
        return $this->numlessons;
    }

    public function setNumlessons(?int $numlessons): self
    {
        $this->numlessons = $numlessons;

        return $this;
    }

    /**
     * @return Collection|Studentdetaill[]
     */
    public function getCourse(): Collection
    {
        return $this->course;
    }

    public function addCourse(Studentdetaill $course): self
    {
        if (!$this->course->contains($course)) {
            $this->course[] = $course;
        }

        return $this;
    }

    public function removeCourse(Studentdetaill $course): self
    {
        $this->course->removeElement($course);

        return $this;
    }

    public function __toString()
    {
        return $this->namecourse;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}

