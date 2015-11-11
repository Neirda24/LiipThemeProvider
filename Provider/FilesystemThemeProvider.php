<?php

namespace Neirda\Bundle\LiipThemeProvider\Provider;

use Neirda\Bundle\LiipThemeProvider\Theme\ThemeProviderInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class FilesystemThemeProvider implements ThemeProviderInterface
{
    /**
     * @var null|array
     */
    protected $themeList = null;

    /**
     * @var array
     */
    protected $paths = array();

    /**
     * Constructor.
     *
     * @param array $paths
     */
    public function __construct(array $paths = array())
    {
        $this->paths = $paths;
    }

    /**
     * {@inheritdoc}
     */
    public function getThemeList()
    {
        if (!is_array($this->themeList)) {
            foreach ($this->paths as $path) {
                $path   = rtrim($path, DIRECTORY_SEPARATOR);
                $themes = new Finder();
                $themes->directories()->depth('== 0')->in($path);
                $themeList = [];
                foreach ($themes as $theme) {
                    /** @var SplFileInfo $theme */
                    $themeList[] = $theme->getFilename();
                }
            }

            $this->themeList = $themeList;
        }

        return $this->themeList;
    }
}
