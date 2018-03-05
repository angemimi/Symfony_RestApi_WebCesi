<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Enseignant
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Serializer\Groups({"get"})
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity="Module", mappedBy="enseignant", cascade={"persist"})
     * 
     * @Serializer\Groups({"modules"})
     */
    private $modules;

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

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getModules()
    {
        return $this->modules;
    }

    public function setModules($modules)
    {
        $this->modules = $modules;

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