<?php

namespace Quiz\QuizBundle\Controller\Helpers;

class TreeHelpers
{
    private $em;
    private $cache;
    
    public function __construct($em, $cache)
    {
        $this->em = $em;
        $this->cache = $cache;
        $this->cache->setNamespace('helpers.tree..');
    }
    
    public function treeShow()
    {
        if($this->cache->contains('full.html'))
        {
            return $this->cache->fetch('full.html');
        }
        else
        {
            $repo  = $this->em->getRepository('\Quiz\QuizBundle\Entity\Category');
            $roots = $repo->getRootNodes();
            $cache = $this->subTreeShow($roots, $repo);
            $this->cache->save('full.html', $cache); // Le cache n'expire jamais : 
            // on élimine ce qu'il faut à chaque création de catégorie. 
            return $cache;
        }
    }
    
    public function treeContents()
    {
        if($this->cache->contains('full.array'))
        {
            return $this->cache->fetch('full.array');
        }
        else
        {
            $repo  = $this->em->getRepository('\Quiz\QuizBundle\Entity\Category');
            $roots = $repo->getRootNodes();
            $data  = $this->subTreeContents($roots, $repo);
            $this->cache->save('full.array', $data); 
            return $data;
        }
    }
    
    private function subTreeShow($nodes, $repo)
    {
        $ret  = '<ul>';
        
        foreach($nodes as $node)
        {
            $ret .= '<li>';
            $ret .= $node;
            if($repo->childCount($node, true))
                $ret .= $this->subTreeShow($repo->children($node, true), $repo);
            $ret .= '</li>';
        }
        
        $ret .= '</ul>';
        
        return $ret;
    }
    
    private function subTreeContents($nodes, $repo)
    {
        $ret = array();
        
        foreach($nodes as $node)
        {
            $add = array();
            $add['title'] = $node->getTitle();
            $add['id']    = $node->getId();
            $add['slug']  = $node->getSlug();
            $add['nb']    = count($node->getQuiz()); 
            if($repo->childCount($node, true))
                $add['children'] = $this->subTreeContents($repo->children($node, true), $repo);
            else
                $add['children'] = array();
            $ret[] = $add;
        }
        
        return $ret;
    }
}