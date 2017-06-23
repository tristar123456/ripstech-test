<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Validator\Constraints\IsNull;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $user = new User();
        //$column = $table->findOneBy(array("username"=>$un,"password"=>$pw))
        foreach($user->getRoles() as $role) {
            if ($role == "ROLE_API") {
                throw $this->createAccessDeniedException("NOT ALLOWES FOR API USER!");
            } elseif ($role == "ROLE_UI") {
                return $this->render('index.html.twig');
            }
            else {
                throw $this->createAccessDeniedException("YOU HAVE NO RIGHT TO SEE THE REQUESTED CONTENT!");
            }
        }
    }
    /**
     * @Route("/database", name="database")
     */
    public function databaseAction() {
        $em = $this->get('doctrine')->getManager();
        $table = $em->getRepository("AppBundle:User")->findAll();

        return $this->render("database.html.twig", array("users"=>$table));
    }
}
