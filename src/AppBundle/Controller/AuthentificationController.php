<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Administrator;
use AppBundle\Entity\Student;
use AppBundle\Entity\Teacher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;

class AuthentificationController extends Controller {
    /**
     * @Rest\Post(
     *      path="/login",
     *      name="app_user_login"
     * )
     * @Rest\View(StatusCode = 201)
     */
    public function login(Request $requset) {
        $em = $this->getDoctrine()->getManager();

        $credentials = json_decode($requset->getContent());

        //Search administrator with this login
        $user = $em->getRepository('AppBundle:Administrator')->findOneBy(['login' => $credentials[0]["login"]], ['password' => $credentials[0]["login"]]);

        // if null search teacher
        if(!$user) {
            $user = $em->getRepository('AppBundle:Teacher')->findOneBy(['login' => $credentials[0]["login"]], ['password' => $credentials[0]["login"]]);
        }
        
        // if null search student
        if(!$user) {
            $user = $em->getRepository('AppBundle:Student')->findOneBy(['login' => $credentials[0]["login"]], ['password' => $credentials[0]["login"]]);
        }

        // if not null return user
        if($user) {
            $response = new Response($user);
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        } else {
            throw $this->unauthorizeException(
                'Login or password unvalid'
            );
        }
    }
}
?>