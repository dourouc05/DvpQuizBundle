<?php

namespace Quiz\QuizBundle\Security;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Bundle\DoctrineBundle\Registry as Doctrine;
use Quiz\QuizBundle\Entity\User;

class LoginFormPreAuthenticateListener
{
    public function handle(Event $event)
    {
        $rq = $event->getRequest()->request;
        if($rq->has('_password') && $rq->has('_username'))
        {
            $xml = new \SimpleXMLElement
                (
                    file_get_contents
                    (
                        'http://www.developpez.net/forums/anologin.php?pseudo=' . $rq->get('_username') . '&motdepasse=' . $rq->get('_username')
                    )
                );
            
            if(0 == $xml->erreur)
                throw new BadCredentialsException($xml->erreur); 
            // $rq->set($id, $val)
            var_dump($xml);

//            $userManager = $container->get('fos_user.user_manager');
//            $user = $userManager->createUser();
            $user = new User();
            $user->setAlgorithm('is_scalar');
        }

            exit;
    }
}