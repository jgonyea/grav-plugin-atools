<?php
namespace Grav\Plugin\Console;

use \Grav\Common\Grav;
use Grav\Console\ConsoleCommand;
use RocketTheme\Toolbox\File\File;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Yaml\Yaml;

/**
 * Class EnablePluginCommand
 *
 * @package Grav\Plugin\Console
 */
class EnablePluginCommand extends ConsoleCommand
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * Enables a plugin.
     */
    protected function configure()
    {
        
        $this
            ->setName("enable-plugin")
            ->setAliases(['en'])
            ->setDescription("Enables a specified plugin.")
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'The name of the plugin to be enabled'
            )
            ->setHelp('The <info>enable</info> command enables a plugin.  Use <info>bin/plugin atools list</info> for a list of available plugins.')
        ;

    }

    /**
     * @return int|null|void
     */
    protected function serve()
    {
        $grav = new Grav();

        // Collects the arguments and options as defined.
        $this->options = [
            'name' => $this->input->getArgument('name')
        ];
        

        $enable_message = "Enabled the <info>" . $this->options['name'] . "</info> plugin.";
        $config_file_path = USER_DIR . "config/plugins/". $this->options['name'] . ".yaml";
        $file = File::instance($config_file_path);
        
        try{
            if ($file->writable()) {
                // Load config file.
                $config_data = Yaml::parse($file->content());
                if ($config_data['enabled'] === true) {
                    $enable_message = "Plugin <info>" . $this->options['name'] . "</info> was already enabled.";
                }
                else {
                    // Set enable plugin option.
                    $config_data['enabled'] = true;
                    // Save config file.
                    $file->save(Yaml::dump($config_data));
                }

                $grav::instance()['log']->info($enable_message);
                $this->output->writeln($enable_message);
            }
        } catch(Exception $e){
            $message = "Failed to enable the " . $this->options['name'] . " plugin.";
            $this->output->writeln($message);
            $grav::instance()['log']->info($message);
            $this->output->writeln("Is the file " . $config_file_path . " writable?");
            
        }
    }
    
}