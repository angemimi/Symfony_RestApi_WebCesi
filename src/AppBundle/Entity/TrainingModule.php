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
     * @ORM\ManyToOne(targetEntity="Training")
     * @ORM\JoinColumn(name="idTraining", referencedColumnName="id")
     */
    private $training;

    /**
     * @ORM\Id
     * 
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumn(name="idModule", referencedColumnName="id")
     */
    private $module;

    /** 
     * @ORM\Column(type="date") 
     * 
     * @Serializer\Groups({"get"})
     */
    private $startDate;

    /** 
     * @ORM\Column(type="date") 
     * 
     * @Serializer\Groups({"get"})
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