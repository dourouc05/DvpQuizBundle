<?php

namespace Quiz\DvpSecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('QuizDvpSecurityBundle:Default:index.html.twig', array('name' => $name));
    }
}
