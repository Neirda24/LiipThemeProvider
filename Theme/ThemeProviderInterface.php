<?php

namespace Neirda\Bundle\LiipThemeProvider\Theme;

interface ThemeProviderInterface
{
    /**
     * Must return a list of themes to add to the ones already available.
     *
     * @return array
     */
    public function getThemeList();
}
