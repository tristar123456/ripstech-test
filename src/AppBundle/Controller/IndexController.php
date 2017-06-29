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
        /*$user = new User();
        $column = $table->findOneBy(array("username"=>$un,"password"=>$pw))
        foreach($user->getRoles() as $role) {
            if ($role == "ROLE_UI") {}
            elseif ($role == "ROLE_API") {
                return $this->render('index.html.twig');
            }
            else{}
        }
        throw $this->createAccessDeniedException("NOT HAVE NOT SUFFICENT RIGHTS TO SEE THIS PAGE!");
        */
        return $this->render("index.html.twig");
    }
    /**
     * @Route("/database/", name="database")
     */
    public function databaseAction() {
        $em = $this->get('doctrine')->getManager();
        $table = $em->getRepository("AppBundle:User")->findAll();
        if($table == null)throw $this->createAccessDeniedException("nene so nich mein freund!");
        return $this->render("database.html.twig", array("users"=>$table));
    }
    /**
     * @Route("/database/delete",name="database_delete")
     */
    public function databaseDeleteAction(){
        $em = $this->get('doctrine')->getManager();
        $table = $em->getRepository("AppBundle:User")->findAll();
        foreach($table as $user){
            if("ryan" == $user->getUsername()){}
            else{
                $em->remove($user);
            }
        };
        $em->flush();
        $table = $em->getRepository("AppBundle:User")->findAll();
        return $this->render("database.html.twig", array("users"=>$table));
    }
    /**
     * @Route("/database/add",name="database_add")
     */
    public function databaseAddAction(){
        $em = $this->get('doctrine')->getManager();
        $user = new User();
        $user2 =new User();
        $user->setPassword("#");
        $user->setUsername("tr");
        $user2->setPassword("#");
        $user2->setUsername("paul");
        $em->persist($user);
        $em->persist($user2);
        $user3=$em->getRepository("AppBundle:User")->findOneBy(array("username"=>"ryan"));
        $user3->addRole("ROLE_API");
        $em->flush();
        $table = $em->getRepository("AppBundle:User")->findAll();
        return $this->render("database.html.twig", array("users"=>$table));
    }
}
