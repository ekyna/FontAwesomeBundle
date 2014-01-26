<?php
/**
 * This file is part of EkynaFontAwesomeBundle.
 *
 * (c) 2013-2014 by Étienne Dauvergne
 */

namespace Ekyna\FontAwesomeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * EkynaFontAwesomeExtension
 *
 * @package    EkynaFontAwesomeBundle
 * @subpackage DependencyInjection
 * @author     Étienne Dauvergne <contact@ekyna.com>
 * @copyright  2013-2014 Étienne Dauvergne
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       https://github.com/ekyna/FontAwesomeBundle FontAwesome for Symfony2
 */
class EkynaFontAwesomeExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('ekyna_fontawesome.output_dir', $config['output_dir']);
        $container->setParameter('ekyna_fontawesome.assets_dir', $config['assets_dir']);
        $container->setParameter('ekyna_fontawesome.configure_assetic', $config['configure_assetic']);
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        if (true === isset($bundles['AsseticBundle']) && true === $config['configure_assetic']) {
            $this->configureAsseticBundle($container, $config);
        }
    }

    /**
     * @param ContainerBuilder $container The service container
     * @param array            $config    The bundle configuration
     *
     * @return void
     */
    protected function configureAsseticBundle(ContainerBuilder $container, array $config)
    {
        foreach (array_keys($container->getExtensions()) as $name) {
            switch ($name) {
                case 'assetic':
                    $asseticConfig = new AsseticConfiguration;
                    $container->prependExtensionConfig(
                        $name,
                        array('assets' => $asseticConfig->build($config))
                    );
                    break;
            }
        }
    }
}
