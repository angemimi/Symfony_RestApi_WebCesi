<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Module;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

class ModuleController extends Controller
{
    /**
     * @Rest\Post(
     *    path = "/modules",
     *    name = "app_module_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("myarr", class="array<AppBundle\Entity\Module>", converter="fos_rest.request_body")
     */
    public function createAction(Array $myarr)
    {
        $em = $this->getDoctrine()->getManager();

        foreach($myarr as $module)
        {
            $em->persist($module);
        }

        $em->flush();

        return $myarr;
    }

    /**
     * @Rest\Get(
     *    path = "/modules/{id}",
     *    name = "app_module_get",
     *    requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 200)
     */
    public function getAction(Module $module)
    {
        $data = $this->get('jms_serializer')->serialize($module, 'json', SerializationContext::create()->setGroups(array('get')));

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Rest\Get("/modules", name="app_module_list")
     * 
     * @Rest\View(StatusCode = 200)
     */
    public function listAction()
    {
        $modules = $this->getDoctrine()->getRepository('AppBundle:Module')->findAll();
        
        $data = $this->get('jms_serializer')->serialize($modules, 'json', SerializationContext::create()->setGroups(array('get')));

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}

?>
