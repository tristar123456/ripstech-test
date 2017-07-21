<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase{

    public function testPointController(){
        $client = static::createClient();
        //Todo:GET
        $crawler = $client->request('GET', array(array("/"),array("/points"));


        //Todo:POST
        $crawler = $client->request('POST', '/points');

        $form = $crawler->selectButton('submit')->form();

        $form['ip']="8.8.8.8";
        $form['name']="";

        $crawler= $client->submit($form);


    }

}