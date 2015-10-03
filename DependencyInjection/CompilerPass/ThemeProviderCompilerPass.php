<?php

namespace Neirda\Bundle\LiipThemeProvider\DependencyInjection\CompilerPass;

use Neirda\Bundle\LiipThemeProvider\LiipThemeProviderTags;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ThemeProviderCompilerPass implements CompilerPassInterface
{
    /**
     * Register all the theme provider in the theme container.
     *
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('liip_theme_provider.theme_container')) {
            return;
        }

        $definition = $container->findDefinition(
            'liip_theme_provider.theme_container'
        );

        $taggedServices = $container->findTaggedServiceIds(
            LiipThemeProviderTags::THEME_PROVIDER
        );
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addThemeProvider',
                array(new Reference($id))
            );
        }
    }
}
