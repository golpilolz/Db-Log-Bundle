<?php

namespace Golpilolz\DbLogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GolpilolzDbLogBundle:Default:index.html.twig');
    }
}
