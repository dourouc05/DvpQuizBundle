<?php

namespace Quiz\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Contrôleur pour la sécurité : formulaire de connexion principalement. 
 *
 * @author Thibaut
 */
class SecurityController extends Controller
{
    public function loginAction()
    {
        $request = $this->container->get('request');
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session */

        // get the error if any (works with forward and redirect -- see below)
        if($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
        {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        elseif(null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR))
        {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        else
        {
            $error = '';
        }

        if ($error)
            $error = $error->getMessage();
        
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        return $this->container
                    ->get('templating')
                    ->renderResponse
                        (
                            'QuizQuizBundle:Security:login.html.'.$this->container->getParameter('fos_user.template.engine'), 
                            array
                                (
                                    'last_username' => $lastUsername,
                                    'error'         => $error,
                                )
                         );
    }
}
