<?php
namespace Grav\Plugin\Console;

use \Grav\Common\Grav;
use Grav\Console\ConsoleCommand;
use Grav\Plugin\AtoolsPlugin;
use RocketTheme\Toolbox\File\File;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Yaml\Yaml;

/**
 * Class DisablePluginCommand
 *
 * @package Grav\Plugin\Console
 */
class DisablePluginCommand extends ConsoleCommand
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * Disables a plugin.
     */
    protected function configure()
    {
        
        $this
            ->setName("disable")
            ->setDescription("Disables a specified plugin.")
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'The name of the plugin to be disabled'
            )
            ->setHelp('The <info>disable</info> command disables a plugin.  Use <info>bin/plugin atools list</info> for a list of available plugins.')
        ;

    }

    /**
     * @return int|null|void
     */
    protected function serve()
    {
        // Collects the arguments and options as defined.
        $this->options = [
            'name' => $this->input->getArgument('name')
        ];
        
        $disable_message = "Disabled the <info>" . $this->options['name'] . "</info> plugin.";
        AtoolsPlugin::disablePlugin("Disabling plugin", 'info', $this->options['name']);
        $this->output->writeln($disable_message);
    }
    
}
