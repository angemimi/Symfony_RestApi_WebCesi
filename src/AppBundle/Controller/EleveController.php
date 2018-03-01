<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Eleve;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

class EleveController extends Controller
{
    /**
     * @Rest\Post(
     *    path = "/eleves",
     *    name = "app_eleve_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("myarr", class="array<AppBundle\Entity\Eleve>", converter="fos_rest.request_body")
     */
    public function createAction(Array $myarr)
    {
        $em = $this->getDoctrine()->getManager();

        foreach($myarr as $eleve)
        {
            $em->persist($eleve);
        }

        $em->flush();

        return $myarr;
    }

    /**
     * @Rest\Get(
     *    path = "/eleves/{id}",
     *    name = "app_eleve_get",
     *    requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 200)
     */
    public function getAction(Eleve $eleve)
    {
        return $eleve;
    }

    /**
     * @Rest\Get("/eleves", name="app_eleve_list")
     */
    public function listAction()
    {
        $formations = $this->getDoctrine()->getRepository('AppBundle:Entity:Eleve')->findAll();
        
        return $formations;
    }
}

?>
