<?php

namespace Quiz\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Quiz\QuizBundle\Controller\Helpers\TreeHelpers;

// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Show quizzes
 */
class QuizController extends Controller
{
    /**
     * @Route("/q{id}/{slug}", name="quizShow")
     * @Template("QuizQuizBundle:Quiz:show.html.twig")
     */
    public function showAction($id, $slug)
    {
        $cat = $this->getDoctrine()
                    ->getEntityManager()
                    ->createQuery('SELECT q, c FROM QuizQuizBundle:Quiz q JOIN QuizQuizBundle:Category c WHERE q.id = :id')
                    ->setParameter('id', $id)
                    ->getSingleResult();
    }
}