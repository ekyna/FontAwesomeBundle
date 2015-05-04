<?php

namespace Ekyna\Bundle\FontAwesomeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class InstallCommand
 * @package Ekyna\Bundle\FontAwesomeBundle\Command
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class InstallCommand extends ContainerAwareCommand
{
    private $config;
    private $basePath;

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('ekyna:fontawesome:install')
            ->setDescription('Installs the FontAwesome icon fonts')
            ->addArgument('write_to', InputArgument::OPTIONAL, 'Override the configured asset root');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->config = $this->getContainer()->getParameter('ekyna_fontawesome.config');
        $this->basePath = $input->getArgument('write_to') ?: $this->getContainer()->getParameter('assetic.write_to');

        $destDir = $this->getDestDir();

        $finder = new Finder;
        $fs = new Filesystem;

        try {
            $fs->mkdir($destDir);
        } catch (IOException $e) {
            $output->writeln(sprintf('<error>Could not create directory %s.</error>', $destDir));

            return;
        }

        $srcDir = $this->getSrcDir();
        if (false === file_exists($srcDir)) {
            $output->writeln(sprintf(
                '<error>Fonts directory "%s" does not exist. Did you install FortAwesome/Font-Awesome? '.
                'If you used something other than Compoer you need to manually change the path in '.
                '"ekyna_fontawesome.assets_dir".</error>',
                $srcDir
            ));

            return;
        }
        $finder->files()->in($srcDir);

        foreach ($finder as $file) {
            $dest = sprintf('%s/%s', $destDir, $file->getBaseName());
            try {
                $fs->copy($file, $dest);
            } catch (IOException $e) {
                $output->writeln(sprintf('<error>Could not copy %s</error>', $file->getBaseName()));
                return;
            }
        }

        $output->writeln(sprintf('Copied FontAwesome fonts to <comment>%s</comment>.', $destDir));
    }

    /**
     * @return string
     */
    protected function getSrcDir()
    {
        return sprintf('%s/fonts', $this->config['assets_dir']);
    }

    /**
     * @return string
     */
    protected function getDestDir()
    {
        $outputDir = $this->config['output_dir'];
        if (strlen($outputDir) > 0 && '/' !== substr($outputDir, -1)) {
            $outputDir .= '/';
        }

        return sprintf(
            '%s/%sfonts',
            rtrim($this->basePath, '/'),
            $outputDir
        );
    }
}
