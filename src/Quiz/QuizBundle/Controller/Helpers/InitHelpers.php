<?php

namespace Quiz\QuizBundle\Controller\Helpers;

use Quiz\QuizBundle\RolesRepository;
use Quiz\QuizBundle\Entity\Rubrique;
use Quiz\QuizBundle\Entity\Category;
use Quiz\QuizBundle\Entity\Answer;
use Quiz\QuizBundle\Entity\Question;
use Quiz\QuizBundle\Entity\Quiz;
use Quiz\QuizBundle\Entity\Group;

/**
 * Helpers for /init routes (template parsing, insertion of groups and roles, etc.)
 *
 * @author Thibaut
 */

class InitHelpers
{
    public function __construct($doctrine)
    {
        $this->em = $doctrine->getEntityManager();
        $this->rubrep = $doctrine->getRepository('\Quiz\QuizBundle\Entity\Rubrique');
        $this->catrep = $doctrine->getRepository('\Quiz\QuizBundle\Entity\Category');
    }
    
    public function importRubriques()
    {
        // Du gabarit, crée une connexion MySQL qu'on utilise
        require_once($_SERVER['DOCUMENT_ROOT'] . '/template/connexion.php');
        mysql_query('SET NAMES UTF8');
        $result = mysql_query('SELECT * FROM RUBRIQUE ORDER BY ID_RUBRIQUE ');
        
        // Pour chaque ligne, on vérifie qu'on a les infos nécessaires (sans quoi
        // tout peut planter à l'affichage...), qu'on n'a pas déjà la rubrique en 
        // base, puis seulement on l'ajoute. 
        while($r = mysql_fetch_assoc($result))
        {
            $r['ID_RUBRIQUE'] = (int) $r['ID_RUBRIQUE'];
            $r['ID_PARENT']   = (int) $r['ID_PARENT'];
            
            // Certaines rubriques n'ont pas besoin d'apparaître ici, surtout qu'elles
            // n'ont pas d'enfant et que cela ne posera aucun problème (club, rubriques
            // fantômes, emploi, bac à sable, etc.). 
            if(in_array($r['ID_RUBRIQUE'], array(6, 14, 15, 22, 23, 24, 26, 28, 35, 48, 52, 62, 63, 112)))
                continue; 
            
            // D'autres rubriques ne peuvent pas apparaître avec parent sous peine
            // de faire apparaître des rubriques stagnantes dans les menus. On donne
            // donc les parents manuellement. 
            switch($r['ID_RUBRIQUE'])
            {
            case 68:  // UNIX
            case 69:  // BSD
            case 110: // Systèmes embarqués
                $r['ID_PARENT'] = 30; // enfants de Systèmes
                break;
            }
            
            $rb = $this->getDoctrine()->getRepository('QuizQuizBundle:Rubrique')->find($r['ID_RUBRIQUE']);

            // Si la rubrique existe déjà, on vérifie qu'on ne doit rien mettre 
            // à jour. 
            if((bool) $rb)
            {
                if($r['PORTAIL'])
                    $rb->setColonneDroite('http://' . $r['URL'] . '/index/rightColumn');
                if($r['XITISITE'] != 0)
                    $rb->setXiti($r['XITISITE']);
                $this->em->persist($rb);
            }
            else
            {
                $en = new Rubrique();
                $en->setId($r['ID_RUBRIQUE']);
                $en->setName($r['LIB']);

                if($r['PORTAIL'])
                    // Quand pas de portail installé (mégarubriques EDI, Langages, 
                    // etc.), on défaulte sur l'accueil. 
                    $en->setColonneDroite('http://' . $r['URL'] . '/index/rightColumn');
                else
                    $en->setColonneDroite('http://www.developpez.com/index/rightColumn');

                if($r['XITISITE'] == 0)
                    // Quand on n'a pas de XiTi, on se démerde et on défaulte 
                    // sur l'accueil. 
                    $en->setXiti(1);
                else
                    $en->setXiti($r['XITISITE']);

                // Quand le gabarit n'a pas de rubrique parente, deux cas sont 
                // possibles : 
                // - soit c'est une vraie rubrique de premier niveau (d'où le 
                //   tableau harcodé) ; 
                // - soit c'est une erreur et on se met sous Autres (21). 
                if($r['ID_PARENT'] == 0)
                    if(in_array($r['ID_RUBRIQUE'], array(1, 4, 8, 13, 20, 30, 42, 54, 86, 88, 89, 90)))
                        $en->setParent(0);
                    else
                        $en->setParent(21);
                else
                    $en->setParent($r['ID_PARENT']);
                
                $this->em->persist($en);
            }
        }
        
        $this->em->flush();
    }
    
    public function importCategories()
    {
        // On insère toutes les catégories pour qu'on puisse mettre les filiations
        // correctes juste après. 
        $rubs = $this->rubrep->findAll();
        
        foreach($rubs as $r)
        {
            try 
            {
                $b = $this->catrep
                          ->createQueryBuilder('c')
                          ->where('c.rubrique = :r')
                          ->setParameter('r', $r)
                          ->getQuery()
                          ->getResult();
            }
            catch(Exception $e)
            {}
            
            
            if(! (bool) $b)
            {
                $cat = new Category();
                $cat->setTitle($r->getName());
                $cat->setRubrique($r);
                $this->em->persist($cat);
            }
        }
        
        $this->em->flush();
        
        // On doit maintenant mettre les bonnes filiations ; on commence par ne 
        // charger que les rubriques devant avoir une catégorie en filiation. 
        
        // C'est ici que les romains s'empoignirent, car on a trop de rubriques
        // avec des parents bizarres (notamment celles qui devraient être 
        // racines et les enfants de Autres). 
        
        $rubs = $this->rubrep
                      ->createQueryBuilder('r')
                      ->where('r.parent != 0')
                      ->orderBy('r.id', 'DESC')
                      ->getQuery()
                      ->getResult();
        
        foreach($rubs as $r)
        {
            if($r->getParent() != 0)
            {
                $catpar = $this->catrep
                               ->createQueryBuilder('c')
                               ->where('c.rubrique = :rub')
                               ->setParameter('rub', $r->getParent())
                               ->getQuery()
                               ->getSingleResult();
            }
            
            $cat = $this->catrep
                           ->createQueryBuilder('c')
                           ->where('c.rubrique = :rub')
                           ->setParameter('rub', $r)
                           ->getQuery()
                           ->getSingleResult();
            
            $cat->setParent($catpar);
            
            $this->em->persist($cat);
        }
        
        $this->em->flush();
    }
    
    public function createFirstQuiz()
    {
        $ans1 = new Answer();
        $ans1->setText('Oui');
        $ans1->setExplanation('Soyons réalistes. ');
        $ans1->setIsRight(true);
        $this->em->persist($ans1);
        
        $ans2 = new Answer();
        $ans2->setText('Non');
        $ans2->setExplanation('Autre chose. '); 
        $this->em->persist($ans2);
        
        $q = new Question();
        $q->setText('Oui ou non ?');
        $q->addAnswer($ans1);
        $q->addAnswer($ans2);
        $this->em->persist($q);
        
        $qu = new Quiz();
        $qu->setName('Premier quiz de test');
        $qu->addQuestion($q);
        $this->em->persist($qu);
        $this->em->flush();
    }
    
    public function createOrUpdateGroups()
    {
        $roles = new RolesRepository();
        
        $grps = $this->em->createQuery('SELECT g FROM QuizQuizBundle:Group g')->getResult();
        
        if(count($grps) == 0)
        {
            $con = new Group('Connectés', $roles->getRolesForConnected());
            $con->setId(1);

            $red = new Group('Rédaction', $roles->getRolesForRedaction());
            $red->setId(2);

            $rsp = new Group('Responsables', $roles->getRolesForResponsables());
            $rsp->setId(3);

            $adm = new Group('Administrateurs', $roles->getRolesForAdministrateurs());
            $adm->setId(4);
        }
        else
        {
            foreach($grps as $g)
            {
                switch($g->getName())
                {
                    case 'Connectés':
                        $con = $g;
                        $con->addRoles($roles->getRolesForConnected());
                        break;
                    case 'Rédaction':
                        $red = $g;
                        $red->addRoles($roles->getRolesForRedaction());
                        break;
                    case 'Responsables':
                        $rsp = $g;
                        $rsp->addRoles($roles->getRolesForResponsables());
                        break;
                    case 'Administrateurs':
                        $adm = $g;
                        $adm->addRoles($roles->getRolesForAdministrateurs());
                        break;
                }
            }
        }
        
        $this->em->persist($con);
        $this->em->persist($red);
        $this->em->persist($rsp);
        $this->em->persist($adm);
        $this->em->flush();
    }
}

