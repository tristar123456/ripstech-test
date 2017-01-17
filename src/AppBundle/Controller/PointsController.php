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
        $input = $request->request;

        if ($input->has('ip')) {
            $ip = $input->get('ip');

            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                $geoip = $this->get('maxmind.geoip')->lookup($ip);

                $lat = $geoip->getLatitude();
                $long = $geoip->getLongitude();
            } else {
                $error = ['message' => 'Invalid IP address provided.'];
                $view = $this->view($error, 400);
            }
        } else {
            $lat = $input->get('lat');
            $long = $input->get('long');
        }

        $point->setLat($lat);
        $point->setLong($long);
        $point->setCreatedAt(new DateTime());

        if ($input->has('icon')) {
            $point->setIcon($input->get('icon'));
        }

        $validator = $this->get('validator');
        $errors = $validator->validate($point);

        if (count($errors) > 0) {
            $view = $this->view($errors, 400);
        } else {
            $em = $this->getDoctrine()->getManager();
            $view = $this->view($point, 200);

            $em->persist($point);
            $em->flush();
        }

        return $this->handleView($view);
    }
}
