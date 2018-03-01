<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\FormationModule;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

class FormationModuleController extends Controller
{
    /**
     * @Rest\Post(
     *    path = "/formation_modules",
     *    name = "app_formation_module_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("myarr", class="array<AppBundle\Entity\FormationModule>", converter="fos_rest.request_body")
     */
    public function createAction(Array $myarr)
    {
        $em = $this->getDoctrine()->getManager();

        foreach($myarr as $formation_module)
        {
            $em->persist($formation_module);
        }

        $em->flush();

        return $myarr;
    }

    /**
     * @Rest\Get(
     *    path = "/formation_modules/{id}",
     *    name = "app_formation_module_get",
     *    requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 200)
     */
    public function getAction(FormationModule $formation_module)
    {
        return $formation_module;
    }

    /**
     * @Rest\Get("/formation_modules", name="app_formation_module_list")
     * 
     * @Rest\View(StatusCode = 200)
     */
    public function listAction()
    {
        $formation_modules = $this->getDoctrine()->getRepository('AppBundle:FormationModule')->findAll();
        
        return $formation_modules;
    }
}

?>
