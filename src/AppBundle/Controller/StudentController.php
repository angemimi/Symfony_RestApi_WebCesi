<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Student;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

class StudentController extends Controller
{
    
    /**
     * @Rest\Post(
     *    path = "/students",
     *    name = "app_students_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("myarr", class="array<AppBundle\Entity\Student>", converter="fos_rest.request_body")
     */
    public function createAction(Array $myarr)
    {
        $em = $this->getDoctrine()->getManager();

        foreach($myarr as $student)
        {
            $student->setRole('Student');
            $em->persist($student);
        }

        $em->flush();

        return $myarr;
    }

    /**
     * @Rest\Get(
     *    path = "/students/{id}",
     *    name = "app_students_get",
     *    requirements = {"id"="\d+"}
     * )
     * @Rest\View(StatusCode = 200)
     */
    public function getAction(Student $students)
    {
        $data = $this->get('jms_serializer')->serialize($students, 'json', SerializationContext::create()->setGroups(array('get_student','TrainingClass')));

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Rest\Get("/students", name="app_students_list")
     * 
     * @Rest\View(StatusCode = 200)
     */
    public function listAction()
    {
        $students = $this->getDoctrine()->getRepository('AppBundle:Student')->findAll();
        
        $data = $this->get('jms_serializer')->serialize($students, 'json', SerializationContext::create()->setGroups(array('get_student','TrainingClass')));

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Rest\Get("/trainingstudents/{id}", 
     *    name="app_students_marks",
     *    requirements = {"id"="\d+"})
     * 
     * @Rest\View(StatusCode = 200)
     */
    public function getMarksAction(Student $students)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $students->getId();
        
        $query = $em->createQuery(
            'SELECT t.id AS idTraining, c.code, c.year, s.name, s.firstname, s.id AS idStudent
             FROM AppBundle\Entity\Training t
             JOIN t.trainingClass c
             JOIN c.students s
             WHERE t.id=?1');
        $query->setParameter(1, $id);
        $result = $query->getResult();
        
        $data = $this->get('jms_serializer')->serialize($result, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Rest\Options("/eleves", name="app_eleve_options")
     * 
     * @rest\View(StatusCode = 200)
     */
    public function optionAction(){
        return true;
    }
}

?>
