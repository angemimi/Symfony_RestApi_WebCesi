<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Formation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class FormationController extends Controller
{
    /**
     * @Rest\Post(
     *    path = "/formations",
     *    name = "app_formation_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("formation", converter="fos_rest.request_body")
     */
    public function createAction(Formation $formation)
    {
        $em = $this->getDoctrine()->getManager();

        $em->persist($formation);
        $em->flush();

        return $formation;
    }
}

?>
