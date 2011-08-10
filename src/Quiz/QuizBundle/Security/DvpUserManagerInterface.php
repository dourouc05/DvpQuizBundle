<?php

namespace Quiz\QuizBundle\Security;

interface DvpUserManagerInterface
{
    function hasUsername($id);
    function getUsernames();
    function getRoles();
    function getRolesForUsername($id);
    function setRolesForUsername($id, array $roles);
}