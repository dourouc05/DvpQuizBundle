<?php

namespace Quiz\QuizBundle\Security;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class DvpUserProvider implements UserProviderInterface
{
    private $userMgr; 
    private $rolePrefix;
    private $defaultRoles;
    
    public function __construct(DvpUserManagerInterface $um, $rolePrefix = 'ROLE_', array $defaultRoles = array())
    {
        $this->userMgr = $um;
        $this->rolePrefix = $rolePrefix; 
        $this->defaultRoles = $defaultRoles; 
    }
    
    /*
     * Username est synonyme d'ID ici !
     */
    public function loadUserByUsername($id)
    {
        if(! $this->userMgr->hasUsername($id))
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
        return new \Quiz\QuizBundle\Entity\User($id, $this->userMgr->getRolesForUsername($id)); 
    }
    
    public function refreshUser(UserInterface $account)
    {
        if(! $account instanceof \Quiz\QuizBundle\Entity\User)
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($account)));
        return $this->loadUserByUsername($account->getId());
    }
    
    public function supportsClass($class)
    {
        return ($class == 'Quiz\QuizBundle\Security\DvpUserProvider');
    }
}