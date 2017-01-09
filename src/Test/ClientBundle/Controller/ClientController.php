<?php

namespace Test\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClientController extends Controller {

    public function clientAction() {
        return $this->render('TestClientBundle:Client:client.html.twig');
    }
    
}
