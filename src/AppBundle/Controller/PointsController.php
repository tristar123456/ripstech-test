<?php

namespace AppBundle\Controller;

use DateTime;
use AppBundle\Entity\Point;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PointsController extends FOSRestController
{
    public function optionsPointsAction()
    {
        $options = [
            'endpoints' => [
                'GET' => [
                    '/points' => [
                        'description' => 'Get collection of points data.',
                        'parameters' => 'none',
                    ],
                ],
                'POST' => [
                    '/points' => [
                        'description' => 'Create new point. Either an IP or lat/long should be specified.',
                        'parameters' => [
                            'lat' => [
                                'description' => 'Latitude of new point',
                                'type' => 'float',
                                'required' => false,
                            ],
                            'long' => [
                                'description' => 'Longitude of new point',
                                'type' => 'float',
                                'required' => false,
                            ],
                            'ip' => [
                                'description' => 'IP address that will be converted to lat/long via geolocation',
                                'type' => 'string',
                                'required' => false,
                            ],
                            'icon' => [
                                'description' => 'Font-Awesome icon name to be used on marker.',
                                'type' => 'string',
                                'required' => false,
                            ],
                            'name' => [
                                'decription' => 'Name of the Point',
                                'type' => 'string',
                                'required' => false,
                            ],
                        ],
                        'example' => [
                            'lat' => 55.55,
                            'long' => 55.55,
                            'ip' => '192.168.1.1',
                            'icon' => 'home',
                        ],
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

    /**
     * @param Request $request
     * @Route("/points",name="add_points")
     */
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
                return $this->render("points.html.twig");
            }
        }
        elseif($input->has('lat') && $input->has('long')) {
            $lat = $input->get('lat');
            $long = $input->get('long');
        }
        else{
            return $this->render("points.html.twig");
        }
        if(isset($lat) && isset($long)) {
            $point->setLat($lat);
            $point->setLong($long);
            if($input->has("point_name")){
                $point->setPointName($input->get("point_name"));
            }
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
                $em->persist($point);
                $em->flush();
            }
        }
        // LONG UND LAT AN INDEX UEBERGEBEN
        $Points = $this->getDoctrine()->getRepository("AppBundle:Point")->findAll();
        if($Points == null){
            return $this->render("add_points");
        }else {
            return $this->render("index.html.twig", array("points" =>$Points));
        }
    }
}
