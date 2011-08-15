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
            $this->cache->save('full.html', $cache, 600); 
            return $cache;
        }
    }
    
    public function treeContents()
    {
        $repo  = $this->em->getRepository('\Quiz\QuizBundle\Entity\Category');
        $roots = $repo->getRootNodes();
        $data  = $this->subTreeContents($roots, $repo);
        print_r($data);exit;
        return $data;
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
            if($repo->childCount($node, true))
                $add['children'] = $this->subTreeContents($repo->children($node, true), $repo);
            $ret[] = $add;
        }
        
        return $ret;
    }
}