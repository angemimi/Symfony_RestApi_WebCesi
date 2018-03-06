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
     * @Serializer\Type("Entity<AppBundle\Entity\Module>")
     * @Serializer\SerializedName("idModule")
     */
    private $modules;

    /**
     * @ORM\Id
     * 
     * @ORM\ManyToOne(targetEntity="Teacher")
     * @ORM\JoinColumn(name="idTeacher", referencedColumnName="id")
     * @Serializer\Type("Entity<AppBundle\Entity\Teacher>")
     * @Serializer\SerializedName("idTeacher")
     * 
     * @Serializer\Groups({"get_teachers"})
     */
    private $teachers;

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