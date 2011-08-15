<?php

namespace Quiz\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Quiz\QuizBundle\Controller\Helpers\TreeHelpers;

// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template("QuizQuizBundle:Index:index.html.twig")
     */
    public function indexAction()
    {
        $helper = new TreeHelpers($this->getDoctrine()->getEntityManager(), $this->get('winzou_cache'));
        return array('rub' => 1, 'cat' => $helper->treeContents());
    }
}
