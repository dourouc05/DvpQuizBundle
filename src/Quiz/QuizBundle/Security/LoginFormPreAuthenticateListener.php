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
    private $em; // Doctrine's entity manager
    private $um; // FOSUserBundle's user manager
    
    public function __construct($em, $um)
    {
        $this->em = $em;
        $this->um = $um; 
//        var_dump(($em));
//        var_dump(($um));
//        exit;
    }
    
    public function handle(Event $event)
    {
        $rq = $event->getRequest()->request;
        if($rq->has('_password') && $rq->has('_username'))
        {
            $xml = 'http://www.developpez.net/forums/anologin.php?pseudo=' . $rq->get('_username') . '&motdepasse=' . $rq->get('_password');
            $xml = file_get_contents($xml);
            $xml = new \SimpleXMLElement($xml);
            
            if(0 == $xml->ok)
            {
                throw new BadCredentialsException($xml->erreur); 
            }
            else
            {
                $user = $this->um->createUser();
                $user->setId($xml->id);
                $user->setUsername($xml->pseudo);
                $user->setEmail($xml->email);
                $user->setFirstName($xml->prenom);
                $user->setName($xml->nom);
                //$xml->redac
                //$xml->resp
                //$xml->admin
                echo 'all good';
            }
            // $rq->set($id, $val)
//            var_dump($xml);
            
        }

            exit;
    }
}