<?php

namespace Quiz\QuizBundle\Security;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Quiz\QuizBundle\Entity\User;

class LoginFormPreAuthenticateListener
{
    public function handle(Event $event)
    {
        if($event->getRequest()->request->has('_password'))
        {
            var_dump($event->getRequest()->request->get('_password'));
            var_dump($event->getRequest()->request->get('_username'));

            $user = new User();

            exit;
        }
    }
}