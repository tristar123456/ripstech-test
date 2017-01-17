<?php

namespace AppBundle\Controller;

use DateTime;
use AppBundle\Entity\Point;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class PointsController extends FOSRestController
{
    public function optionsPointsAction()
    {
        $options = [
            'endpoints' => [
                'GET' => [
                    '/users' => [
                    
                    ],
                ],
                'POST' => [
                    '/users' => [
                    
                    ],
                ],
            ],
        ];
        $view = $this->view($options, 200);

        return $this->handleView($view);
    }

    public function getPointsAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Point');
        $points = $repository->findAll();
        $view = $this->view($points, 200);

        return $this->handleView($view);
    }
    
    public function postPointsAction(Request $request)
    {
        $point = new Point();

        $point->setLat($request->request->get('lat'));
        $point->setLong($request->request->get('long'));
        $point->setCreatedAt(new DateTime());

        $validator = $this->get('validator');
        $errors = $validator->validate($point);

        if (count($errors) > 0) {
            $view = $this->view($errors, 400);

            return $this->handleView($view);
        }

        $em = $this->getDoctrine()->getManager();
        $view = $this->view($point, 200);

        $em->persist($point);
        $em->flush();

        return $this->handleView($view);
    }
}
