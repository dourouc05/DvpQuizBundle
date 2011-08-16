<?php

namespace Quiz\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Quiz\QuizBundle\Controller\Helpers\TreeHelpers;
use Quiz\QuizBundle\Form\QuizForm;

// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Show quizzes
 */
class QuizController extends Controller
{
    /**
     * @Route("/q{id}/{slug}", name="quizShow", requirements={"id" = "\d+", "slug" = ".+"}, defaults={"slug" = ""})
     * @Template("QuizQuizBundle:Quiz:show.html.twig")
     */
    public function showAction($id, $slug)
    {
        $quiz = $this->getDoctrine()
                     ->getEntityManager()
                     ->createQuery('SELECT q, c, r FROM QuizQuizBundle:Quiz q JOIN q.category c JOIN c.rubrique r WHERE q.id = :id')
                     ->setParameter('id', $id)
                     ->getSingleResult();
        
        if($slug != $quiz->getSlug())
            return $this->redirect($this->generateUrl('indexCategory', array('id' => $id, 'slug' => $quiz->getSlug())), 301);
        
        $fb = new QuizForm($this->get('winzou_cache'));
        $form = $fb->buildForm($quiz, $this->getRequest()); 
        
        return array('rub' => $quiz->getCategory()->getRubrique()->getId(), 'quiz' => $quiz, 'form' => $form); 
    }
}