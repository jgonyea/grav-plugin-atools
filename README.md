# Atools Plugin

The **Atools** Plugin is for [Grav CMS](http://github.com/getgrav/grav). Anarchy Tools suite extends additional functionality to both the grav cli and grav admin plugins, mainly for the developer experience.

## Installation

Installing the Atools plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install atools

This will install the Atools plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/atools`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `atools`. You can find these files on [GitHub](https://github.com/jgonyea/grav-plugin-atools) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/atools

> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

### Admin Plugin

If you use the admin plugin, you can install directly through the admin plugin by browsing the `Plugins` tab and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/atools/atools.yaml` to `user/config/plugins/atools.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

Note that if you use the admin plugin, a file with your configuration, and named atools.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the admin.

## Usage

### CLI Commands

Use the command `bin/plugin atools` followed by one of the following:

1. `list-plugin` or `list` : Lists all installed plugins
2. `enable-plugin PLUGINNAME` or `en PLUGINNAME` : Enables the plugin PLUGINNAME
3. `disable-plugin PLUGINNAME` or `dis PLUGINNAME` : Disables the plugin PLUGINNAME

### Developer usage

A plugin developer can use the `AtoolsPlugin::disablePlugin($message, $level, $plugin_name)` php function to disable a plugin.
* `$message`: the message logged to admin/ Grav log
* `$level`: Log level
* `$plugin_name`: Slug name of plugin

Example: `bin/plugin atools enable admin`

## Credits

Atools name is inspired by the Drupal Chaos Tool Suite, aka [ctools](https://www.drupal.org/project/ctools/)

## To Do

* Check dependencies for plugins.
* Make sure that a plugin exists before attempting enabling/ disabling it.
* More functionality to come.