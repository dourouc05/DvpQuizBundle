<?php

namespace Quiz\QuizBundle\Twig\Extension;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;

class QuizQuizExtension extends \Twig_Extension
{
    private $em;
    private $cache;
    
    public function __construct($em, $cache)
    {
        $this->em = $em;
        $this->cache = $cache;
        $this->cache->setNamespace('twig.extension.gabarit..');
    }
    
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'gabarit';
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            'gab_right' => new \Twig_Filter_Method($this, 'gabRight', array('is_safe' => array('html'))),
            'gab_up'    => new \Twig_Filter_Method($this, 'gabUp',    array('is_safe' => array('html'))),
            'gab_down'  => new \Twig_Filter_Method($this, 'gabDown',  array('is_safe' => array('html'))),
            'var_dump'  => new \Twig_Filter_Method($this, 'varDump',  array('is_safe' => array('html'))),
        );
    }
    
    public function gabRight($id)
    {
        if($this->cache->contains('right.' . $id))
        {
            return $this->cache->fetch('right.' . $id);
        }
        else
        {
            $col = $this->em->createQuery('SELECT r.colonneDroite FROM QuizQuizBundle:Rubrique r WHERE r.id = :id')
                            ->setParameter('id', $id)
                            ->getSingleResult();
            $cache = utf8_encode(file_get_contents($col['colonneDroite']));
            $this->cache->save('right.' . $id, $cache, 600); 
            return $cache;
        }
    } 
    
    public function gabUp($id)
    {
        return utf8_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/template/caches/tetexhtml' . $id . '.cache'));
    }
    
    public function gabDown($id)
    {
        return utf8_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/template/caches/piedxhtml' . $id . '.cache'));
    }
    
    public function varDump($what)
    {
        var_dump($what);
        exit;
    }
}