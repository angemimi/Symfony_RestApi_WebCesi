<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Formation
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="FormationModule", mappedBy="formation", cascade={"persist"})
     */
    private $modules;

    /**
     * @ORM\OneToMany(targetEntity="Promotion", mappedBy="formation", cascade={"persist"})
     */
    private $promotions;

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

    public function getmodules()
    {
        return $this->modules;
    }

    public function setmodules($modules)
    {
        $this->modules = $modules;

        return $this;
    }

    public function getPromotion()
    {
        return $this->promotions;
    }

    public function setPromotion($promotions)
    {
        $this->promotions = $promotions;

        return $this;
    }
}