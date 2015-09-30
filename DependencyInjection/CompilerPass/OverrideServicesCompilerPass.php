<?php

namespace Neirda\Bundle\LiipThemeProvider\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideServicesCompilerPass implements CompilerPassInterface
{
    /**
     * Override the default LiipThemeBundle services by the ones in this bundle
     *
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->has('liip_theme.theme_controller') && $container->has('liip_theme_provider.theme_controller')) {
            $container->setDefinition('liip_theme.theme_controller', $container->getDefinition('liip_theme_provider.theme_controller'));
        }

        if ($container->has('liip_theme.active_theme') && $container->has('liip_theme_provider.active_theme')) {
            $container->setDefinition('liip_theme.active_theme', $container->getDefinition('liip_theme_provider.active_theme'));
        }
    }
}
