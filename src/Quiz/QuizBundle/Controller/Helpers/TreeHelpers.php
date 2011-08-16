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
            $this->cache->save('full.array', $data, 600); 
            return $data;
        }
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