<?php

namespace Quiz\QuizBundle\Security;

interface DvpUserManagerInterface
{
    function hasUsername($id);
    function getUsernames();
    function getRoles();
    function getRolesForId($id);
    function setRolesForId($id, array $roles);
}