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
     * @Rest\Patch(
     *    path = "/module/{id}",
     *    name = "app_module_update",
     *    requirements = {"id"="\d+"}
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("module", class="AppBundle\Entity\Module", converter="fos_rest.request_body")
     */
    public function updateAction($id, Module $module) {
        $em = $this->getDoctrine()->getManager();
        $mod = $em->getRepository('AppBundle:Module')->find($id);
        $mod->setTitle($module->title);
        $mod->setContent($module->content);
        $mod->setTraining($module->training);
        $mod->setTeacher($module->teachers);

        $em->flush();

        return $mod;
    }

    /**
     * @Rest\Delete(
     *    path = "/module/{id}",
     *    name = "app_module_delete",
     *    requirements = {"id"="\d+"}
     * @Rest\View(StatusCode = 201)
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        
        $module = $em->getRepository('AppBundle:Module')->find($id);

        $em->remove($module);
        $em->flush();
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
        $data = $this->get('jms_serializer')->serialize($module, 'json', SerializationContext::create()->setGroups(array('get_module','teachers','get_teachers')));

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
        
        $data = $this->get('jms_serializer')->serialize($modules, 'json', SerializationContext::create()->setGroups(array('get_module','teachers','get_teachers')));

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Rest\Post(
     *    path = "/addmark",
     *    name = "app_training_addmark"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("myarr", class="array<AppBundle\Entity\StudentModule>", converter="fos_rest.request_body")
     */
    public function addMarkAction(Array $myarr)
    {
        $em = $this->getDoctrine()->getManager();

        foreach($myarr as $studentModule)
        {
            $studentModule->setIsValid(0);
            $em->persist($studentModule);
        }

        $em->flush();

        return $myarr;
    }

    /**
     * @Rest\Patch(
     *    path = "/marks/valid/{id}",
     *    name = "app_training_validmark"
     *    requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("studModule", class="AppBundle\Entity\StudentModule", converter="fos_rest.request_body")
     */
    public function validMarkAction($id, StudentModule $studModule) {
        $em = $this->getDoctrine()->getManager();

        $studentModule = $em->getRepository('AppBundle:StudentModule')->find($id);
        $studentModule->setIsValid(1);

        $em->flush();

        return $myarr;
    }

    /**
     * @Rest\Post(
     *    path = "/addteacher",
     *    name = "app_training_addteacher"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("myarr", class="array<AppBundle\Entity\ModuleTeacher>", converter="fos_rest.request_body")
     */
    public function addTeacherAction(Array $myarr)
    {
        $em = $this->getDoctrine()->getManager();

        foreach($myarr as $moduleTeacher)
        {
            $em->persist($moduleTeacher);
        }

        $em->flush();

        return $myarr;
    }

    /**
     * @Rest\Options("/modules", name="app_module_options")
     * 
     * @rest\View(StatusCode = 200)
     */
    public function optionAction(){
        return true;
    }
}

?>
