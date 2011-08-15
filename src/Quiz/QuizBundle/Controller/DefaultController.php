<?php

namespace Quiz\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Quiz\QuizBundle\Controller\Helpers\TreeHelpers;

// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Indexes
 */
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
        // If user is allowed to see deleted quizzes, let's show him! This shall also work
        // with redactor's quizzes when it gets implemented. 
        $userCanSeeDeleted = $this->get('security.context')->isGranted('ROLE_QUIZ_SEE_ALL');
        
        $cat = $this->getDoctrine()
                    ->getEntityManager()
                    ->createQuery('SELECT c, r FROM QuizQuizBundle:Category c JOIN c.rubrique r WHERE c.id = :id')
                    ->setParameter('id', $id)
                    ->getSingleResult();
        
        // Redirect ASAP, to avoid too many SQL requests. 
        // 301: Moved Permanently
        // Without "return," redirect does not actually happen (it just returns a Response, which is lost otherwise). 
        if($slug != $cat->getSlug())
            return $this->redirect($this->generateUrl('indexCategory', array('id' => $id, 'slug' => $cat->getSlug())), 301);
        
        $quiz = $this->getDoctrine()
                     ->getRepository('\Quiz\QuizBundle\Entity\Quiz')
                     ->findByWithUser(array('category' => $cat->getId()), null, null, null, $userCanSeeDeleted);
        
        return array('rub' => $cat->getRubrique()->getId(), 'cat' => $cat->getTitle(), 'quiz' => $quiz);
    }
}
