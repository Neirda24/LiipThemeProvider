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
     * Constructor.
     *
     * @param array $defaultThemeList
     */
    public function __construct(array $defaultThemeList = array())
    {
        $this->defaultThemeList = $defaultThemeList;
        $this->themeProviders   = array();
        $this->themeList        = null;
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
        if (null === $this->themeList) {
            $this->themeList = $this->defaultThemeList;
            foreach ($this->themeProviders as $themeProvider) {
                /** @var ThemeProviderInterface $themeProvider */
                $this->themeList = array_merge($this->themeList, $themeProvider->getThemeList());
            }
        }

        if (null === $this->themeList) {
            $this->themeList = array();
        }

        return $this->themeList;
    }
}
