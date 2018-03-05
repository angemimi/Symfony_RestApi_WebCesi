<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class ModuleTeacher
{
    /**
     * @ORM\Id
     * 
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumn(name="idModule", referencedColumnName="id")
     */
    private $modules;

    /**
     * @ORM\Id
     * 
     * @ORM\ManyToOne(targetEntity="Teacher")
     * @ORM\JoinColumn(name="idTeacher", referencedColumnName="id")
     */
    private $teachers;

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

    public function getModules()
    {
        return $this->modules;
    }

    public function setModules($modules)
    {
        $this->modules = $modules;

        return $this;
    }

    public function getTeachers()
    {
        return $this->teachers;
    }

    public function setTeachers($teachers)
    {
        $this->teachers = $teachers;

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