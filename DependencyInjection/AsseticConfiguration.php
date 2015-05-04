<?php

namespace Ekyna\Bundle\FontAwesomeBundle\DependencyInjection;


/**
 * Class AsseticConfiguration
 * @package Ekyna\Bundle\FontAwesomeBundle\DependencyInjection
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class AsseticConfiguration
{
    /**
     * Builds the assetic configuration.
     *
     * @param array $config
     * @return array
     */
    public function build(array $config)
    {
        $output = array();

        // Fix path in output dir
        if ('/' !== substr($config['output_dir'], -1) && strlen($config['output_dir']) > 0) {
            $config['output_dir'] .= '/';
        }

        $output['fontawesome_css'] = $this->buildCssWithoutLess($config);

        /*if ('none' !== $config['less_filter']) {
            $output['fontawesome_css'] = $this->buildCssWithLess($config);
        } else {
            $output['fontawesome_css'] = $this->buildCssWithoutLess($config);
        }*/

        return $output;
    }

    /**
     * @param array $config
     * @return array
     */
    protected function buildCssWithoutLess(array $config)
    {
        $inputs = array(
            $config['assets_dir'].'/css/font-awesome.css',
        );

        return array(
            'inputs'  => $inputs,
            'filters' => array('cssrewrite'),
            'output'  => $config['output_dir'].'css/fontawesome.css',
            'debug'   => false
        );
    }

    /**
     * @param array $config
     * @return array
     */
    /*protected function buildCssWithLess(array $config)
    {
        $bootstrapFile = $config['assets_dir'].'/less/font-awesome.less';
        if (true === isset($config['customize']['variables_file']) &&
            null !== $config['customize']['variables_file']) {
            $bootstrapFile = $config['customize']['fontawesome_output'];
        }

        return array(
            'inputs'  => $inputs,
            'filters' => array($config['less_filter']),
            'output'  => $config['output_dir'].'css/font-awesome.css'
        );
    }*/
}
