<?php

namespace AppBundle\Controller;

use DateTime;
use AppBundle\Entity\Statistic;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class StatisticsController extends FOSRestController
{
    public function optionsStatisticsAction()
    {
        $options = [
            'endpoints' => [
                'GET' => [
                    '/statistics' => [
                        'description' => 'Get collection of statistics data.',
                        'parameters' => 'none',
                    ],
                ],
                'POST' => [
                    '/statistics' => [
                        'description' => 'Create new statistic entry. Date, product id, country, net value and gross value need to be specified.',
                        'parameters' => [
                            'date' => [
                                'description' => 'Date of the statistic entry',
                                'type' => 'string',
                                'required' => false,
                            ],
                            'product_id' => [
                                'description' => 'Product id of the statistic entry',
                                'type' => 'string',
                                'required' => true,
                            ],
                            'country' => [
                                'description' => 'Country of the statistic entry',
                                'type' => 'string',
                                'required' => true,
                            ],
                            'net' => [
                                'description' => 'Net value of the statistic entry',
                                'type' => 'float',
                                'required' => true,
                            ],
                            'gross' => [
                                'description' => 'Gross value of the statistic entry',
                                'type' => 'float',
                                'required' => true,
                            ],
                        ],
                        'example' => [
                            'date' => '2017-06-10',
                            'product_id' => '1',
                            'country' => 'DE',
                            'net' => 123.45,
                            'gross' => 100.00,
                        ],
                    ],
                ],
            ],
        ];
        $view = $this->view($options, 200);

        return $this->handleView($view);
    }

    public function getStatisticsAction()
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Statistic');
        $statistics = $repository->findAll();
        $view = $this->view($statistics, 200);

        return $this->handleView($view);
    }

    public function postStatisticsAction(Request $request)
    {
        $statistic = new Statistic();
        $input = $request->request;

        // Get Date
        if ($input->has('date')) {
            $date = new DateTime($input->get('date'));
            $statistic->setDate($date);
        } else {
            $statistic->setDate(new DateTime());
        }

        // Get product id
        $statistic->setProductId($input->get('product_id'));

        // Get country
        $statistic->setCountry($input->get('country'));

        // Get net value
        $statistic->setNet($input->get('net'));

        // Get gross value
        $statistic->setGross($input->get('gross'));

        $statistic->setCreatedAt(new DateTime());

        $validator = $this->get('validator');
        $errors = $validator->validate($statistic);

        if (count($errors) > 0) {
            $view = $this->view($errors, 400);
        } else {
            $em = $this->getDoctrine()->getManager();
            $view = $this->view($statistic, 200);

            $em->persist($statistic);
            $em->flush();
        }

        return $this->handleView($view);
    }
}