<?php
namespace Grav\Plugin;

use \Grav\Common\Grav;
use Grav\Common\Cache;
use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;
use RocketTheme\Toolbox\File\File;
use Symfony\Component\Yaml\Yaml;


/**
 * Class AtoolsPlugin
 * @package Grav\Plugin
 */
class AtoolsPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized'],
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }
    }


    /**
     * Disables a plugin.
     */
    public static function disablePlugin($message, $level = "info", $plugin_name)
    {
        $grav = new Grav();

        // Double check that the plugin isn't already disabled.
        if ($grav::instance()['config']['plugins'][$plugin_name]['enabled'] === false) {
            $gui_message = "Plugin '" . $plugin_name . "' was already disabled.  No action performed.";
            $grav::instance()['log']->info($gui_message);
            $grav::instance()['messages']->add($gui_message, "info");
            return;
        }

        $disable_message = "Disabled the '" . $plugin_name . "' plugin.  Please refresh the admin/plugins page.";

        $config_file_path = USER_DIR . "config/plugins/". $plugin_name . ".yaml";
        $file = File::instance($config_file_path);

        if ($file->writable()) {
            // Load config file.
            $config_data = Yaml::parse($file->content());
            // Disable plugin option.
            $config_data['enabled'] = false;
            // Save config file.
            $file->save(Yaml::dump($config_data));

            $grav::instance()['log']->info($message);
            $grav::instance()['log']->info($disable_message);
            $grav::instance()['messages']->add($message, $level);
            $grav::instance()['messages']->add($disable_message, 'warning');
            Cache::clearCache('standard');
        }
    }

}
