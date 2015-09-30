<?php

namespace Neirda\Bundle\LiipThemeProvider\Controller;

use Doctrine\ORM\EntityManager;
use Neirda\Bundle\LiipThemeProvider\ThemeContainerInterface;
use Liip\ThemeBundle\ActiveTheme;
use Liip\ThemeBundle\Controller\ThemeController as Base;
use Symfony\Component\HttpFoundation\Request;

class ThemeController extends Base
{
    /**
     * @var ThemeContainerInterface|null
     */
    protected $themeContainer = null;

    /**
     * {@inheritdoc}
     */
    public function __construct(ActiveTheme $activeTheme, array $themes, array $cookieOptions)
    {
        parent::__construct($activeTheme, $themes, $cookieOptions);
    }

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
    public function switchAction(Request $request)
    {
        if ($this->themeContainer instanceof ThemeContainerInterface) {
            $this->themes = $this->themeContainer->getThemeList();
        }

        return parent::switchAction($request);
    }
}
