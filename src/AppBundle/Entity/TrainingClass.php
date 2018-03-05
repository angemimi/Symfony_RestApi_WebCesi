<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class TrainingClass
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Serializer\Groups({"id_TrainingClass","get"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Serializer\Groups({"get"})
     */
    private $code;

    /** 
     * @ORM\Column(type="integer") 
     * 
     * @Serializer\Groups({"get"})
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="Training", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="idTraining", referencedColumnName="id")
     * @Serializer\Type("Entity<AppBundle\Entity\Training>")
     * @Serializer\SerializedName("idTraining")
     * 
     * @Serializer\Groups({"Training"})
     */
    private $training;

    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="trainingClass", cascade={"persist"})
     * 
     * @Serializer\Groups({"Students"})
     */
    private $students;

    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("idTraining")
     */
    public function idTraining()
    {
        return $this->training->getCode();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    public function getTraining()
    {
        return $this->training;
    }

    public function setTraining($training)
    {
        $this->training = $training;

        return $this;
    }

    public function getStudents()
    {
        return $this->students;
    }

    public function setStudents($students)
    {
        $this->students = $students;

        return $this;
    }
}