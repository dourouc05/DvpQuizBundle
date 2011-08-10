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
                $q = $this->em->createQuery('SELECT u FROM QuizQuizBundle:User u WHERE u.id = :id')
                              ->setParameter('id', $xml->id)
                              ->getResult();
                
                if(count($q) == 0) // pas d'utilisateur déjà en base, on devra le créer de zéro ; sinon, on laisse Sf2 et FOSUB gérer le tout
                {
                    $user = $this->um->createUser();
                    $user->setId($xml->id);
                    $user->setUsername($xml->pseudo);
                    echo 'creative mood' . "\n";
                }
                else // déjà en base, on fait les modifications nécessaires pour que tout soit bien synchronisé
                {
                    $user = $q[0];
                }
                $user->setEmail($xml->email);
                $user->setFirstName($xml->prenom);
                $user->setName($xml->nom);
                $user->setRedaction($xml->redac);
                $user->setResponsable($xml->resp);
                $user->setAdministrateur($xml->admin);
                $this->em->persist($user);
                $this->em->flush();
                echo 'all good';
            }
        }

            exit;
    }
}