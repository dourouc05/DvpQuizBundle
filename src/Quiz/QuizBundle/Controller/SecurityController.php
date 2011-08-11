<?php

namespace Quiz\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Contrôleur pour la sécurité : formulaire de connexion principalement. 
 *
 * @author Thibaut
 */
class SecurityController extends Controller
{
    /**
     * @Route("/deconnexion", name="security_logout")
     * @Template("QuizQuizBundle:Init:rubriques.html.twig")
     */
    public function logoutAction() {}
    
    /**
     * @Route("/connexion/verification", name="security_check")
     * @Template("QuizQuizBundle:Init:rubriques.html.twig")
     */
    public function checkAction() {}
    
    /**
     * @Route("/connexion", name="security_login")
     * @Template("QuizQuizBundle:Security:login.html.twig")
     */
    public function loginAction()
    {
        $request = $this->container->get('request');
        $session = $request->getSession();

        if($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
        {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR)->getMessage();
        }
        elseif(null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR))
        {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR)->getMessage();
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        else
        {
            $error = '';
        }
        
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        return array('last_username' => $lastUsername, 'error' => $error, 'rub' => 1);
    }
}
