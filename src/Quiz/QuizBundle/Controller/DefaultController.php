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
        $em = $this->getDoctrine()->getEntityManager(); 
        $cat = $em->createQuery('SELECT c, r FROM QuizQuizBundle:Category c JOIN c.rubrique r WHERE c.id = :id')
                  ->setParameter('id', $id)
                  ->getSingleResult();
        
        if($slug != $cat->getSlug())
            $this->redirect($this->generateUrl('indexCategory', array('id' => $id, 'slug' => $cat->getSlug())), 302);
        
        return array('rub' => $cat->getRubrique()->getId());
    }
}
