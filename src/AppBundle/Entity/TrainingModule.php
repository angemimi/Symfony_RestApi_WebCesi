<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class TrainingModule
{

    /**
     * @ORM\Id
     * 
     * @ORM\ManyToOne(targetEntity="Training", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="idTraining", referencedColumnName="id")
     * @Serializer\Type("Entity<AppBundle\Entity\Training>")
     * @Serializer\SerializedName("idTraining")
     */
    private $training;

    /**
     * @ORM\Id
     * 
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumn(name="idModule", referencedColumnName="id")
     * @Serializer\Type("Entity<AppBundle\Entity\Module>")
     * @Serializer\SerializedName("idModule")
     * 
     * @Serializer\Groups({"get_training"})
     */
    private $module;

    /** 
     * @ORM\Column(type="date") 
     * 
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("startDate")
     * @Serializer\Type("DateTime<'d-m-Y'>")
     */
    private $startDate;

    /** 
     * @ORM\Column(type="date") 
     * 
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("endDate")
     * @Serializer\Type("DateTime<'d-m-Y'>")
     */
    private $endDate;

    public function getId()
    {
        return $this->id;
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

    public function getModule()
    {
        return $this->module;
    }

    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }
}