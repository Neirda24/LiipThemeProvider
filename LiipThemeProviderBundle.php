<?php

namespace Neirda\Bundle\LiipThemeProvider;

use Neirda\Bundle\LiipThemeProvider\DependencyInjection\CompilerPass\OverrideServicesCompilerPass;
use Neirda\Bundle\LiipThemeProvider\DependencyInjection\CompilerPass\ThemeProviderCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LiipThemeProviderBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ThemeProviderCompilerPass());
        $container->addCompilerPass(new OverrideServicesCompilerPass());
    }
}
