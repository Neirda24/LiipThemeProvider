[![SensioLabsInsight](https://insight.sensiolabs.com/projects/ecf43130-0672-4fb8-98b2-56a8f732421e/big.png)](https://insight.sensiolabs.com/projects/ecf43130-0672-4fb8-98b2-56a8f732421e)

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require neirda24/liipthemeprovider "~1"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Neirda\Bundle\LiipThemeProvider\LiipThemeProviderBundle(),
        );

        // ...
    }

    // ...
}
```

How to use it
=============

Step 1: Create your provider class
----------------------------------

```php
<?php
// src/AppBundle/ThemeProvider

use Neirda\Bundle\LiipThemeProvider\ThemeProviderInterface;

// ...
class ThemeProvider implements ThemeProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getThemeList()
    {
        // implement your logic here...
        // it should return an array event if it is empty
    }

    // ...
}
```

Step 2: Declare the service
---------------------------

Your service must be tagged with `liip_theme_provider.theme_provider`.

XML:
```xml
...

    <services>
        ...
        <service id="app.theme.provider" class="AppBundle\ThemeProvider\ThemeProvider">
            <tag name="liip_theme_provider.theme_provider" />
        </service>
        ...
    </services>
...
```

**Done !!**

Example
=======

Create this class:
 
```php
<?php
// src/AppBundle/ThemeProvider

use Neirda\Bundle\LiipThemeProvider\Theme\ThemeProviderInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class ThemeProvider implements ThemeProviderInterface
{
    /**
     * @const THEMES_PATH
     */
    const THEMES_PATH = 'src/AppBundle/Resources/themes';

    /**
     * @var string
     */
    protected $rootDir;

    /**
     * @var null|array
     */
    protected $themeList = null;

    /**
     * Constructor.
     *
     * @param string $rootDir
     */
    public function __construct($rootDir)
    {
        $this->rootDir = $rootDir;
    }

    /**
     * {@inheritdoc}
     */
    public function getThemeList()
    {
        if (!is_array($this->themeList)) {
            $path   = rtrim($this->rootDir, '/') . '/' . ltrim(static::THEMES_PATH, '/');
            $themes = new Finder();
            $themes->directories()->depth('== 0')->in($path);
            $themeList = [];
            foreach ($themes as $theme) {
                /** @var SplFileInfo $theme */
                $themeList[] = $theme->getFilename();
            }

            $this->themeList = $themeList;
        }

        return $this->themeList;
    }
}
```

And declare your service:

xml
---

```xml
...
<services>
    <service id="app.theme.provider" class="AppBundle\Provider\ThemeProvider">
        <argument>%kernel.root_dir%/../</argument>
        <tag name="liip_theme_provider.theme_provider" />
    </service>
</services>
...
```

Now, all you have to do is just creating a new folder and it will be automatically added to the themes available.
