<?php

namespace Quiz\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Quiz\QuizBundle\Entity\Rubrique;
use Quiz\QuizBundle\Entity\Category;

/**
 * Description of InitController
 *
 * @author Thibaut
 */
class InitController extends Controller
{
    private $root;
    private $autres;
    private $rubrep;
    private $catrep;
    
    public function importRubriquesAction()
    {
        $this->em = $this->getDoctrine()->getEntityManager();
        $this->rubrep = $this->getDoctrine()->getRepository('\Quiz\QuizBundle\Entity\Rubrique');
        $this->catrep = $this->getDoctrine()->getRepository('\Quiz\QuizBundle\Entity\Category');
        
        $this->importRubriques();
        $this->em->flush();
        
        $this->importCategories();
        $this->em->flush();
        
        return $this->render('QuizQuizBundle:Init:index.html.twig');
    }
    
    private function importRubriques()
    {
        // Du gabarit, crée une connexion MySQL qu'on utilise
        require_once($_SERVER['DOCUMENT_ROOT'] . '/template/connexion.php');
        $result = mysql_query('SELECT * FROM RUBRIQUE ORDER BY ID_RUBRIQUE');
        
        // Pour chaque ligne, on vérifie qu'on a les infos nécessaires (sans quoi
        // tout peut planter à l'affichage...), qu'on n'a pas déjà la rubrique en 
        // base, puis seulement on l'ajoute. 
        while($r = mysql_fetch_assoc($result))
        {
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
    }
    
    private function importCategories()
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
                          ->where('c.id = :id')
                          ->setParameter('id', $r->getId())
                          ->getQuery()
                          ->getResult();
            }
            catch(\Doctrine\Orm\NoResultException $e)
            {
                $p = $r->getParent();

                $cat = new Category();
                $cat->setTitle($r->getName());
                $cat->setRubrique($r);

                $this->em->persist($cat);
            }
            catch(Exception $e)
            {}
        }
        
        $this->em->flush();
        
        // On doit maintenant mettre les bonnes filiations ; on commence par ne 
        // charger que les rubriques devant avoir une catégorie en filiation. 
        
        $rubs = $this->rubrep
                      ->createQueryBuilder('r')
                      ->where('r.parent != 0')
                      ->getQuery()
                      ->getResult();
        
        foreach($rubs as $r)
        {
            $catpar = $this->catrep
                           ->createQueryBuilder('c')
                           ->where('c.rubrique = :rub')
                           ->setParameter('rub', $r->getParent())
                           ->getQuery()
                           ->getSingleResult();
            
            $cat = $this->catrep
                           ->createQueryBuilder('c')
                           ->where('c.rubrique = :rub')
                           ->setParameter('rub', $r)
                           ->getQuery()
                           ->getSingleResult();
            
            $cat->setParent($catpar);
            
            $this->em->persist($cat);
        }
    }
}
