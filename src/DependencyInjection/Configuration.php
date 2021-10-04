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
                ->scalarNode('api_key')->end()
                ->scalarNode('signature_key')->end()
                ->booleanNode('sandbox')->defaultTrue()->end()
                ->scalarNode('sandbox_api_key')->end()
                ->scalarNode('sandbox_signature_key')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}