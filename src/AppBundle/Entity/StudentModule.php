<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class StudentModule
{
    /**
     * @ORM\Id
     * 
     * @ORM\ManyToOne(targetEntity="Student")
     * @ORM\JoinColumn(name="idStudent", referencedColumnName="id")
     * @Serializer\Type("Entity<AppBundle\Entity\Student>")
     * @Serializer\SerializedName("idStudent")
     */
    private $students;

    /**
     * @ORM\Id
     * 
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumn(name="idModule", referencedColumnName="id")
     * @Serializer\Type("Entity<AppBundle\Entity\Module>")
     * @Serializer\SerializedName("idModule")
     */
    private $module;

    /**
     * @ORM\Column(type="float", length=100)
     */
    private $note;

    /**
     * @ORM\Column(type="string")
     */
    private $comment;

    /** 
     * @ORM\Column(type="date") 
     * 
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("moduleDate")
     * @Serializer\Type("DateTime<'d-m-Y'>")
     */
    private $moduleDate;

    /** 
     * @ORM\Column(type="boolean") 
     * 
     * @Serializer\Groups({"get"})
     * @Serializer\SerializedName("isRemedial")
     */
    private $isRemedial;

    public function getModule()
    {
        return $this->module;
    }

    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    public function getStudent()
    {
        return $this->students;
    }

    public function setStudent($students)
    {
        $this->students = $students;

        return $this;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    public function getModuleDate()
    {
        return $this->moduleDate;
    }

    public function setModuleDate($moduleDate)
    {
        $this->moduleDate = $moduleDate;

        return $this;
    }

    public function getIsRemedial()
    {
        return $this->isRemedial;
    }

    public function setIsRemedial($isRemedial)
    {
        $this->isRemedial = $isRemedial;

        return $this;
    }
}