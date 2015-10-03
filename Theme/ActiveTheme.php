<?php

namespace Neirda\Bundle\LiipThemeProvider\Theme;

use Liip\ThemeBundle\ActiveTheme as Base;
use Liip\ThemeBundle\Helper\DeviceDetectionInterface;

class ActiveTheme extends Base
{
    /**
     * @var bool
     */
    protected $isInitialized = false;

    /**
     * @var ThemeContainerInterface|null
     */
    protected $themeContainer;

    /**
     * Get ThemeContainer
     *
     * @return ThemeContainerInterface|null
     */
    public function getThemeContainer()
    {
        return $this->themeContainer;
    }

    /**
     * Set ThemeContainer
     *
     * @param ThemeContainerInterface|null $themeContainer
     *
     * @return $this
     */
    public function setThemeContainer(ThemeContainerInterface $themeContainer = null)
    {
        $this->themeContainer = $themeContainer;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function __construct($name, array $themes = array(), DeviceDetectionInterface $deviceDetection = null)
    {
        parent::__construct($name, $themes, $deviceDetection);
    }

    /**
     * Initialize the theme list.
     */
    public function init()
    {
        if (!$this->isInitialized) {
            $this->setThemes($this->themeContainer->getThemeList());
            $this->isInitialized = true;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getThemes()
    {
        $this->init();
        return parent::getThemes();
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->init();
        parent::setName($name);
    }
}
