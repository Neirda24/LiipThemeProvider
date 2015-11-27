<?php

namespace Neirda\Bundle\LiipThemeProvider\Controller;

use Neirda\Bundle\LiipThemeProvider\Theme\ThemeContainerInterface;
use Liip\ThemeBundle\ActiveTheme;
use Liip\ThemeBundle\Controller\ThemeController as Base;
use Symfony\Component\HttpFoundation\Request;

class ThemeController extends Base
{
    /**
     * @var null|ThemeContainerInterface
     */
    protected $themeContainer = null;

    /**
     * {@inheritdoc}
     * @param null|ThemeContainerInterface $themeContainer
     */
    public function __construct(ActiveTheme $activeTheme, array $themes, array $cookieOptions, ThemeContainerInterface $themeContainer = null)
    {
        $this->themeContainer = $themeContainer;
        parent::__construct($activeTheme, $themes, $cookieOptions);
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
