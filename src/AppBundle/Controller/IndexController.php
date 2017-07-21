<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Validator\Constraints\IsNull;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function indexAction()
    {
        $user = $this->getUser();
        foreach($user->getRoles() as $role) {
            if ($role == "ROLE_UI") {}
            elseif ($role == "ROLE_API") {
                $points = $this->getDoctrine()->getRepository("AppBundle:Point")->findAll();
                if($points == null){
                    return $this->render("index.html.twig");
                }
                return $this->render("index.html.twig", array("points"=> $points));
            }
            else{}
        }
        throw $this->createAccessDeniedException("NOT HAVE NOT SUFFICENT RIGHTS TO SEE THIS PAGE!");

    }
}
