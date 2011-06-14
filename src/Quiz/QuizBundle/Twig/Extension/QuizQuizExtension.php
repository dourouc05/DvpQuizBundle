<?php

namespace Quiz\QuizBundle\Twig\Extension;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;

class QuizQuizExtension extends \Twig_Extension
{
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
        );
    }
    
    public function gabRight($rubrique)
    {
        return utf8_encode(file_get_contents('http://' . $rubrique . '.developpez.com/index/rightColumn'));
    } 
    
    public function gabUp($id)
    {
        // return utf8_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/template/caches/tetexhtml' . $id . '.cache'));
        return utf8_encode(file_get_contents('http://www.developpez.com/template/caches/tetexhtml' . $id . '.cache'));
    }
    
    public function gabDown($id)
    {
        // return utf8_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/template/caches/piedxhtml' . $id . '.cache'));
        return utf8_encode(file_get_contents('http://www.developpez.com/template/caches/piedxhtml' . $id . '.cache'));
    }
}