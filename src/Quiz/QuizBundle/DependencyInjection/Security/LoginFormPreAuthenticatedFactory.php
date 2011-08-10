<?php

namespace Quiz\QuizBundle\DependencyInjection\Security;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;

class HttpBasicPreAuthenticatedFactory implements SecurityFactoryInterface
{
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $provider = 'security.authentication.provider.pre_authenticated.'.$id;
        $container
            ->setDefinition($provider, new DefinitionDecorator('security.authentication.provider.pre_authenticated'))
            ->replaceArgument(0, new Reference($userProvider))
            ->addArgument($id)
            ->addTag('security.authentication_provider')
        ;

        $listener = new Definition(
            'Quiz\QuizBundle\Security\LoginFormPreAuthenticatedListener',
            array(
                new Reference('security.context'),
                new Reference('security.authentication.manager'),
                $id,
                new Reference('logger', ContainerBuilder::IGNORE_ON_INVALID_REFERENCE),
            )
        );
        $listener->addTag('monolog.logger', array('channel' => 'security'));

        $listenerId = 'dvp.authentication.listener.login_form_pre_auth.'.$id;
        $container->setDefinition($listenerId, $listener);

        return array($provider, $listenerId, $defaultEntryPoint);
    }

    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'login-form-pre-auth';
    }

    public function addConfiguration(NodeDefinition $builder)
    {
        $builder->children()->scalarNode('provider')->end()->end();
    }
}