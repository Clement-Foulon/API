<?php

namespace Test\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TestApiBundle:Default:index.html.twig');
    }
}
