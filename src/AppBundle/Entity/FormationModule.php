<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class FormationModule
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Formation", cascade={"all"}, fetch="EAGER")
     */
    private $formation;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Module", cascade={"all"}, fetch="EAGER")
     */
    private $module;

    public function getId()
    {
        return $this->id;
    }

    public function getFormation()
    {
        return $this->formation;
    }

    public function setFormation($formation)
    {
        $this->formation = $formation;

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
}