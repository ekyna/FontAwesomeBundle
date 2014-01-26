<?php

namespace Ekyna\FontAwesomeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ekyna_fontawesome');

        $rootNode
            ->children()
                ->scalarNode('output_dir')->defaultValue('')->end()
                ->scalarNode('assets_dir')
                    ->defaultValue('%kernel.root_dir%/../vendor/fortawesome/font-awesome')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
