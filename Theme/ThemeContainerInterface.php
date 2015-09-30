<?php

namespace Neirda\Bundle\LiipThemeProvider\Theme;

interface ThemeContainerInterface
{
    /**
     * Register a theme provider.
     *
     * @param ThemeProviderInterface $themeProviderInterface
     *
     * @return $this
     */
    public function addThemeProvider(ThemeProviderInterface $themeProviderInterface);

    /**
     * Return the merge array list of theme.
     *
     * @return array
     */
    public function getThemeList();
}
