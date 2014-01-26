<?php
/**
 * This file is part of EkynaFontAwesomeBundle.
 *
 * (c) 2013-2014 by Étienne Dauvergne
 */

namespace Ekyna\FontAwesomeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 *
 * @package    EkynaFontAwesomeBundle
 * @subpackage DependencyInjection
 * @author     Étienne Dauvergne <contact@ekyna.com>
 * @copyright  2013-2014 Étienne Dauvergne
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/ekyna/FontAwesomeBundle FontAwesome for Symfony2
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
                ->scalarNode('output_dir')
                    ->defaultValue('')
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
