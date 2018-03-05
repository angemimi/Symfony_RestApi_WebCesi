<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Training
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Serializer\Groups({"id_training","get_training"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Serializer\Groups({"get_training"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Serializer\Groups({"get_training"})
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="TrainingModule", mappedBy="training", cascade={"persist"})
     * 
     * @Serializer\Groups({"modules"})
     */
    private $modules;

    /**
     * @ORM\OneToMany(targetEntity="TrainingClass", mappedBy="training", cascade={"persist"})
     * 
     * @Serializer\Groups({"TrainingClass"})
     */
    private $trainingClass;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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

    public function getmodules()
    {
        return $this->modules;
    }

    public function setmodules($modules)
    {
        $this->modules = $modules;

        return $this;
    }

    public function getTrainingClass()
    {
        return $this->trainingClass;
    }

    public function setTrainingClass($trainingClass)
    {
        $this->trainingClass = $trainingClass;

        return $this;
    }
}