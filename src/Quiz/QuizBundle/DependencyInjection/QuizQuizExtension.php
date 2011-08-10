<?php

namespace Quiz\QuizBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class QuizQuizExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $yloader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $yloader->load('services.yml');
        
        $xloader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $xloader->load('services.xml');
    }
}
