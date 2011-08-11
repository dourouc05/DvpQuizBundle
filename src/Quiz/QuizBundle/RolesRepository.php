<?php

namespace Quiz\QuizBundle;

/**
 * Repository for all Roles you can imagine out there (generic ones, of course). 
 * 
 * Can output roles for each group (all, redac, resp, admin). 
 * 
 * Cannot output roles for individuals (roles given by resp/admin to create
 * section quiz). 
 *
 * @author Thibaut
 */
class RolesRepository
{
    private $roles = array();
    
    public function __construct()
    {
        /**
         * Quiz rubrique : affiché dans les listings si visible, uniquement à l'aide d'un lien sinon. 
         * 
         * Quiz rédacteur : affiché uniquement quand on a un lien, peu importe la visibilité (sauf pour la rédaction, 
         * à des fins de modération si besoin). 
         * 
         * Un quiz ne peut être affiché sous sa forme light pour intégration dans le kit que s'il est visible. 
         */
        
        /**
         * Les groupes sont, actuellement : 
         *  - tout le monde ; 
         *  - connecté ; 
         *  - rédaction ; 
         *  - responsables ; 
         *  - administrateurs. 
         * 
         * Les membres d'un groupe font partie du groupe de granularité supérieure. Les groupes sont vérifiés à chaque
         * connexion avec le forum (AnoLogin). 
         */
        
        /**
         * Voir et répondre à un quiz
         * 
         * Tout le monde peut :
         *  - voir et répondre à un quiz, participation aux stats. 
         * Il faut être connecté pour : 
         *  - voir ses propres résultats enregistrés ; 
         *  - enregistrer ses réponses et continuer plus tard. 
         * Il faut être membre de la rédaction pour : 
         *  - voir tous les quiz, visibles ou non, rédacteur ou rubrique. 
         */
        $this->addRoleForEveryone       ('ROLE_QUIZ_SEE_VISIBLE'); 
        $this->addRoleForConnected      ('ROLE_QUIZ_SEE_STATS'); 
        $this->addRoleForConnected      ('ROLE_QUIZ_SEE_SAVE'); 
        $this->addRoleForRedaction      ('ROLE_QUIZ_SEE_ALL');
        
        /**
         * Créer un quiz
         * 
         * Il faut être connecté pour : 
         *  - créer un quiz rédacteur ;
         *  - éditer ses propres quiz. 
         * Il faut être responsable pour : 
         *  - créer un quiz rubrique pour toutes les rubriques ;
         *  - éditer tous les quiz. 
         * 
         * Il faut être autorisé spécialement par un responsable pour une seule rubrique à la fois pour : 
         *  - créer un quiz rubrique pour une rubrique (ROLE_QUIZ_CREATE_RUB_$rub). 
         */
        $this->addRoleForConnected      ('ROLE_QUIZ_CREATE_RED'); 
        $this->addRoleForConnected      ('ROLE_QUIZ_EDIT_RED_SELF');
        $this->addRoleForResponsables   ('ROLE_QUIZ_CREATE_RUB'); 
        $this->addRoleForResponsables   ('ROLE_QUIZ_EDIT_ALL'); 
        
        /**
         * Gérer les droits
         * 
         * Il faut être responsable pour : 
         *  - donner le droit à quelqu'un de créer un quiz rubrique pour une rubrique. 
         */
        $this->addRoleForResponsables   ('ROLE_ROLES_GIVE_RUB');
        
        /**
         * Administration
         * 
         * Il faut être responsable pour : 
         *  - relancer l'importation des rubriques et des catégories ; 
         *  - gérer les catégories ; 
         *  - vider les caches CacheBundle.
         * 
         * Il faut être administrateur pour : 
         *  - lancer les initialisations (routes /init/*) ; 
         *  -  vider les caches.
         */
        $this->addRoleForResponsables   ('ROLE_CAT');
        $this->addRoleForResponsables   ('ROLE_INIT_RUB');
        $this->addRoleForResponsables   ('ROLE_CACHE_BUNDLE');
        $this->addRoleForAdministrateurs('ROLE_INIT_ALL');
        $this->addRoleForAdministrateurs('ROLE_CACHE_ALL');
    }
    
    private function addRoleForEveryone($role)
    {
        $this->roles['all'][] = $role;
    }
    
    private function addRoleForConnected($role)
    {
        $this->roles['con'][] = $role;
    }
    
    private function addRoleForRedaction($role)
    {
        $this->roles['red'][] = $role;
    }
    
    private function addRoleForResponsables($role)
    {
        $this->roles['rsp'][] = $role;
    }
    
    private function addRoleForAdministrateurs($role)
    {
        $this->roles['adm'][] = $role;
    }
    
    public function getRolesForEveryone()
    {
        return $this->roles['all'];
    }
    
    public function getRolesForConnected()
    {
        return $this->roles['con'];
    }
    
    public function getRolesForRedaction()
    {
        return $this->roles['red'];
    }
    
    public function getRolesForResponsables()
    {
        return $this->roles['rsp'];
    }
    
    public function getRolesForAdministrateurs()
    {
        return $this->roles['adm'];
    }
}