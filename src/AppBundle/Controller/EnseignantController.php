<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Enseignant;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

class EnseignantController extends Controller
{
    /**
     * @Rest\Post(
     *    path = "/enseignants",
     *    name = "app_enseignant_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("myarr", class="array<AppBundle\Entity\Enseignant>", converter="fos_rest.request_body")
     */
    public function createAction(Array $myarr)
    {
        $em = $this->getDoctrine()->getManager();

        foreach($myarr as $enseignant)
        {
            $em->persist($enseignant);
        }

        $em->flush();

        return $myarr;
    }

    /**
     * @Rest\Get(
     *    path = "/enseignants/{id}",
     *    name = "app_enseignant_get",
     *    requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 200)
     */
    public function getAction(Enseignant $enseignant)
    {
        $data = $this->get('jms_serializer')->serialize($enseignant, 'json', SerializationContext::create()->setGroups(array('get')));

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Rest\Get("/enseignants", name="app_enseignant_list")
     * 
     * @Rest\View(StatusCode = 200)
     */
    public function listAction()
    {
        $enseignants = $this->getDoctrine()->getRepository('AppBundle:Enseignant')->findAll();
        
        $data = $this->get('jms_serializer')->serialize($enseignants, 'json', SerializationContext::create()->setGroups(array('get')));

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}

?>
