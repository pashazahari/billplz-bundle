<?php

namespace Fd\BillplzBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('fd_billplz');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('api_key')->isRequired()->end()
                ->scalarNode('signature_key')->isRequired()->end()
                ->booleanNode('sandbox')->isRequired()->end()
                ->scalarNode('sandbox_api_key')->isRequired()->end()
                ->scalarNode('sandbox_signature_key')->isRequired()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}