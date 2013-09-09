<?php

namespace Edlcdmc\Bundle\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('EdlcdmcCommonBundle:Default:index.html.twig', array('name' => $name));
    }
}
