<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 * @ORM\Table(name="student", indexes={@ORM\Index(columns={"fullname", "telephone","dateofbirth","numstudent"}, flags={"fulltext"})})
 */
class Student
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
    private $fullname;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $father;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mother;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placeofbirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $studying;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adress;

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

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=Studentdetaill::class, mappedBy="student")
     */
    private $studentdetaills;

    /**
     * @ORM\OneToMany(targetEntity=Payment::class, mappedBy="student")
     */
    private $payments;

    /**
    * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateofbirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numstudent;





    

    public function __construct()
    {
        $this->studentdetaills = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(?string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }
    public function getNumstudent(): ?string
    {
        return $this->numstudent;
    }

    public function setNumstudent(?string $numstudent): self
    {
        $this->numstudent = $numstudent;

        return $this;
    }


    public function getFather(): ?string
    {
        return $this->father;
    }

    public function setFather(?string $father): self
    {
        $this->father = $father;

        return $this;
    }

    public function getMother(): ?string
    {
        return $this->mother;
    }

    public function setMother(?string $mother): self
    {
        $this->mother = $mother;

        return $this;
    }

    public function getplaceofbirth(): ?string
    {
        return $this->placeofbirth;
    }

    public function setplaceofbirth(string $placeofbirth): self
    {
        $this->placeofbirth = $placeofbirth;

        return $this;
    }

    public function getDateofbirth(): ?string
    {
        return $this->dateofbirth;
    }

    public function setDateofbirth(string $dateofbirth): self
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    public function getStudying(): ?string
    {
        return $this->studying;
    }

    public function setStudying(string $studying): self
    {
        $this->studying = $studying;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

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

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Studentdetaill[]
     */
    public function getStudentdetaills(): Collection
    {
        return $this->studentdetaills;
    }

    public function addStudentdetaill(Studentdetaill $studentdetaill): self
    {
        if (!$this->studentdetaills->contains($studentdetaill)) {
            $this->studentdetaills[] = $studentdetaill;
            $studentdetaill->setStudent($this);
        }

        return $this;
    }

    public function removeStudentdetaill(Studentdetaill $studentdetaill): self
    {
        if ($this->studentdetaills->removeElement($studentdetaill)) {
            // set the owning side to null (unless already changed)
            if ($studentdetaill->getStudent() === $this) {
                $studentdetaill->setStudent(null);
            }
        }

        return $this;
    }

    

    /**
     * @return Collection|Payment[]
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments[] = $payment;
            $payment->setStudent($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): self
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getStudent() === $this) {
                $payment->setStudent(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->fullname;
    }







}
