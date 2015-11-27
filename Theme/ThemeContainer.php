<?php

namespace Neirda\Bundle\LiipThemeProvider\Theme;

class ThemeContainer implements ThemeContainerInterface
{
    /**
     * @var array
     */
    protected $defaultThemeList;

    /**
     * @var ThemeProviderInterface[]
     */
    protected $themeProviders;

    /**
     * @var array
     */
    protected $themeList;

    /**
     * @var bool
     */
    protected $isInitialized;

    /**
     * Constructor.
     *
     * @param array $defaultThemeList
     */
    public function __construct(array $defaultThemeList = array())
    {
        $this->defaultThemeList = $defaultThemeList;
        $this->themeProviders   = array();
        $this->isInitialized    = false;
        $this->themeList        = array();
    }

    /**
     * {@inheritdoc}
     */
    public function addThemeProvider(ThemeProviderInterface $themeProviderInterface)
    {
        $this->themeProviders[] = $themeProviderInterface;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getThemeList()
    {
        if (false === $this->isInitialized) {
            $this->themeList = $this->defaultThemeList;
            foreach ($this->themeProviders as $themeProvider) {
                /** @var ThemeProviderInterface $themeProvider */
                $this->themeList = array_merge($this->themeList, $themeProvider->getThemeList());
            }
            $this->isInitialized = true;
        }

        return $this->themeList;
    }
}
