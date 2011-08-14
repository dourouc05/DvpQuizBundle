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
        if($this->cache->contains('full'))
        {
            return $this->cache->fetch('full');
        }
        else
        {
            $repo  = $this->em->getRepository('\Quiz\QuizBundle\Entity\Category');
            $roots = $repo->getRootNodes();
            $cache = $this->subTreeShow($roots, $repo);
            $this->cache->save('full', $cache, 600); 
            return $cache;
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
}