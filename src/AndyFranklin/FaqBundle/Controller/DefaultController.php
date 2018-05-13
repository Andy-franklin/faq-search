<?php

namespace AndyFranklin\FaqBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AndyFranklinFaqBundle:Default:index.html.twig');
    }
}
