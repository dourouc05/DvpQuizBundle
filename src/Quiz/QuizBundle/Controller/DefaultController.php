<?php

namespace Quiz\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Quiz\QuizBundle\Controller\Helpers\TreeHelpers;

// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template("QuizQuizBundle:Index:index.html.twig")
     */
    public function indexAction()
    {
        $helper = new TreeHelpers($this->getDoctrine()->getEntityManager(), $this->get('winzou_cache'));
        return array('rub' => 1, 'cat' => $helper->treeContents());
    }
    
    /**
     * @Route("/c{id}/{slug}", name="indexCategory", requirements={"id" = "\d+", "slug" = ".+"}, defaults={"slug" = ""})
     * @Template("QuizQuizBundle:Index:category.html.twig")
     */
    public function indexCategoryAction($id, $slug)
    {
//        $xat = $this->getDoctrine()
//                    ->getRepository('\Quiz\QuizBundle\Entity\Category')
//                    ->createQueryBuilder('c')
//                    ->select('c')
//                    ->where('c.id = :id')
//                    ->setParameter('id', $id)
//                    ->getQuery()
//                    ->getSingleResult();
        $cat = $this->getDoctrine()
                    ->getEntityManager()
                    ->createQuery('SELECT c, r FROM QuizQuizBundle:Category c JOIN c.rubrique r WHERE c.id = :id')
                    ->setParameter('id', $id)
                    ->getSingleResult();
        $quiz = $this->getDoctrine()
                     ->getRepository('\Quiz\QuizBundle\Entity\Quiz')
                     ->findBy(array('category' => $cat));
//        $quiz = $this->getDoctrine()
//                     ->getEntityManager()
//                     ->createQuery('SELECT q FROM QuizQuizBundle:Quiz q WHERE q.category = :cat AND q.deleted = :deleted')
//                     ->setParameter('cat', $cat)
//                     ->setParameter('deleted', false)
//                     ->getResult();
        
        if($slug != $cat->getSlug())
            return $this->redirect($this->generateUrl('indexCategory', array('id' => $id, 'slug' => $cat->getSlug())), 301);
        // 301: Moved Permanently
        // Without "return," redirect does not actually happen (it just returns a Response, which is lost otherwise). 
        
        return array('rub' => $cat->getRubrique()->getId(), 'cat' => $cat->getTitle(), 'quiz' => $quiz);
    }
}
