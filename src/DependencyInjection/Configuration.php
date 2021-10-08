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
                ->booleanNode('enable_sandbox')->isRequired()->end()
                ->arrayNode('sandbox')
                    ->children()
                        ->scalarNode('api_key')->isRequired()->end()
                        ->scalarNode('signature_key')->isRequired()->end()
                        ->arrayNode('collection')
                            ->arrayPrototype()
                                ->children()
                                    ->scalarNode('name')->end()
                                    ->scalarNode('id')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('live')
                    ->children()
                        ->scalarNode('api_key')->isRequired()->end()
                        ->scalarNode('signature_key')->isRequired()->end()
                        ->arrayNode('collection')
                            ->arrayPrototype()
                                ->children()
                                    ->scalarNode('name')->end()
                                    ->scalarNode('id')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}