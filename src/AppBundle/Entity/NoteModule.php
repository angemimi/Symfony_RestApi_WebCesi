<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class NoteModule
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Formation", cascade={"all"}, fetch="EAGER")
     */
    private $enseignant;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Eleve", cascade={"all"}, fetch="EAGER")
     */
    private $eleve;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Module", cascade={"all"}, fetch="EAGER")
     */
    private $module;

    /**
     * @ORM\Column(type="float", length=100)
     */
    private $note;

    /**
     * @ORM\Column(type="string")
     */
    private $commentaire;

    public function getEnseignant()
    {
        return $this->enseignant;
    }

    public function setEnseignant($enseignant)
    {
        $this->enseignant = $enseignant;

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

    public function getEleve()
    {
        return $this->eleve;
    }

    public function setEleve($eleve)
    {
        $this->eleve = $eleve;

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

    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}