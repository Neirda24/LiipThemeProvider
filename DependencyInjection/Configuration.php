<?php

namespace Neirda\Bundle\LiipThemeProvider\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $config      = $treeBuilder->root('liip_theme_provider');

        $config
            ->children()
                ->arrayNode('filesystem')
                    ->prototype('scalar')
                        ->example('- %kernel.root_dir%/../src/AppBundle/Resources/themes')
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
