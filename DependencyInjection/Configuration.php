<?php

namespace Ekyna\Bundle\FontAwesomeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Ekyna\Bundle\FontAwesomeBundle\DependencyInjection
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ekyna_font_awesome');

        $rootNode
            ->children()
                ->scalarNode('output_dir')
                    ->defaultValue('') // TODO default = assets
                ->end()
                ->scalarNode('assets_dir')
                    ->defaultValue('%kernel.root_dir%/../vendor/fortawesome/font-awesome')
                ->end()
                ->booleanNode('configure_assetic')
                    ->defaultValue(true)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
