<?php
namespace Grav\Plugin\Console;

use Grav\Console\ConsoleCommand;
use Grav\Common\Grav;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Helper\Table;
use League\CLImate\CLImate;

/**
 * Class ListPluginCommand
 *
 * @package Grav\Plugin\Console
 */
class ListPluginCommand extends ConsoleCommand
{

    /**
     * Lists all installed plugins.
     */
    protected function configure()
    {
        
        $this
            ->setName("list")
            ->setDescription("Lists installed plugins.")
            ->setHelp('The <info>list</info> command lists all installed plugins.')
        ;

    }

    /**
     * @return int|null|void
     */
    protected function serve()
    {
        $grav = new Grav();
        $plugins = $grav::instance()['config']['plugins'];
        $header = ["name", "enabled"];
        $climate = new CLImate;
        $climate->extend('Grav\Console\TerminalObjects\Table');
        $table = [];

        foreach ($plugins as $name => $plugin){
            $row = [
                'Slug name' => $this->colorizeEnabled($name, $name),
                'Plugin enabled' => $this->colorizeEnabled($name, $plugin['enabled'])
            ];
            $table[] = $row;
        }
        $this->output->writeln('');
        $this->output->writeln('The following packages were found:');
        $this->output->writeln('');
        $climate->table($table);
        $this->output->writeln('');
        
        
        // More colors available at:
        // https://github.com/getgrav/grav/blob/develop/system/src/Grav/Console/ConsoleTrait.php
    }

    /**
     * Colorizes output based on whether the package is enabled or disabled.
     * @return string Colorized string for console output.
     */
    private function colorizeEnabled ($package, $value)
    {
        $grav = new Grav();
        // Convert booleans to readable text.
        if ($value === true) {
            $value = "True";
        }
        elseif ($value === false) {
            $value = "False";
        }

        // Colorize output.
        if ($grav::instance()['config']['plugins'][$package]['enabled']){
            return "<green>" . $value . "</green>";
        }
        else {
            return "<red>" . $value . "</red>";
        }
    }
}