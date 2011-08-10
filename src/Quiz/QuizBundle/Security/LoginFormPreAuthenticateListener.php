<?php

namespace Quiz\QuizBundle\Security;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Quiz\QuizBundle\Entity\User;

class LoginFormPreAuthenticateListener
{
    public function handle(Event $event)
    {
        $rq = $event->getRequest()->request;
        if($rq->has('_password'))
        {
            // $rq->set($id, $val)
            var_dump($rq->get('_password'));
            var_dump($rq->get('_username'));

            $user = new User();

            exit;
        }
    }
}