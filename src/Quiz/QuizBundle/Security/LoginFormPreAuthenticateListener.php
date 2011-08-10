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
//            $xml = 'http://www.developpez.net/forums/anologin.php?pseudo=' . $rq->get('_username') . '&motdepasse=' . $rq->get('_password');
//            var_dump($xml);
//            $xml = file_get_contents($xml);
//            var_dump($xml);
//            $xml = new \SimpleXMLElement($xml);
//            var_dump($xml);
            
            if(0 == $xml->erreur)
            {
                throw new BadCredentialsException($xml->erreur); 
            }
            else
            {
                $entityManager = $this->get('doctrine.orm.entity_manager');
                $user = new User();
                $user->setAlgorithm('is_scalar');
                $user->setId($xml->id);
                $user->setUsername($xml->pseudo);
                $user->setEmail($xml->email);
                $user->setFirstName($xml->prenom);
                $user->setName($xml->nom);
                //$xml->redac
                //$xml->resp
                //$xml->admin
            }
            // $rq->set($id, $val)
//            var_dump($xml);

//            $userManager = $container->get('fos_user.user_manager');
//            $user = $userManager->createUser();
            
        }

            exit;
    }
}