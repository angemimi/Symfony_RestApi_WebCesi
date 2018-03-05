<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Module
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Serializer\Groups({"get"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Serializer\Groups({"get"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Serializer\Groups({"get"})
     */
    private $contenu;

    /**
     * @ORM\OneToMany(targetEntity="FormationModule", mappedBy="module", cascade={"persist"})
     * 
     * @Serializer\Groups({"formations"})
     */
    private $formation;

    /**
     * @ORM\ManyToOne(targetEntity="Enseignant", cascade={"all"}, fetch="EAGER")
     * 
     * @Serializer\Groups({"enseignant"})
     */
    private $enseignant;

    /**
     * @ORM\OneToMany(targetEntity="NoteModule", mappedBy="module", cascade={"persist"})
     * 
     * @Serializer\Groups({"notes"})
     */
    private $notes;


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

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
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

    public function getEnseignant()
    {
        return $this->enseignant;
    }

    public function setEnseignant($enseignant)
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }
}