<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\NoteModule;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

class NoteModuleController extends Controller
{
    /**
     * @Rest\Post(
     *    path = "/notes",
     *    name = "app_notes_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("myarr", class="array<AppBundle\Entity\NoteModule>", converter="fos_rest.request_body")
     */
    public function createAction(Array $myarr)
    {
        $em = $this->getDoctrine()->getManager();

        foreach($myarr as $note)
        {
            $em->persist($note);
        }

        $em->flush();

        return $myarr;
    }
    
    /**
     * @Rest\Options("/notes", name="app_note_options")
     * 
     * @rest\View(StatusCode = 200)
     */
    public function optionAction(){
        return true;
    }
}

?>
