<?php

namespace Quiz\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Quiz\QuizBundle\Controller\Helpers\InitHelpers;

// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Initializers
 *
 * @author Thibaut
 * @Route("/init")
 */
class InitController extends Controller
{
    private $helper;
    
    private function _begin()
    {
        $this->helper = new InitHelpers($this->getDoctrine());
    }
    
    /**
     * @Route("/securite", name="init_securite")
     * @Template("QuizQuizBundle:Init:security.html.twig")
     * #Secure(roles="ROLE_INIT_ALL")
     *
     * Ce contrôleur n'est pas à sécuriser, sinon on ne peut pas initialiser
     * l'application de zéro. 
     */
    public function initializeSecurityAction()
    {
        $this->_begin();
        $this->helper->createOrUpdateGroups();
        return array('rub' => 1);
    }
    
    /**
     * @Route("/rubriques", name="init_rubriques")
     * @Template("QuizQuizBundle:Init:rubriques.html.twig")
     * #Secure(roles="ROLE_INIT_RUB")
     */
    public function importRubriquesAction()
    {
        $this->_begin();
        $this->helper->importRubriques(); 
        $this->helper->importCategories();
        return array('rub' => 1);
    }
    
    /**
     * @Route("/premier-quiz", name="init_quiz")
     * @Template("QuizQuizBundle:Init:quiz.html.twig")
     * @Secure(roles="ROLE_INIT_ALL")
     */
    public function createQuizAction()
    {
        $this->_begin();
        $this->helper->createFirstQuiz();
        return array('rub' => 1);
    }
}
