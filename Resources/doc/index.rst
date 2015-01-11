Currency Bundle
===============

The bundle with abstract Currency entity based on Currency's data of Symfony
(Intl Component)[http://symfony.com/doc/current/components/intl.html]
used for fixtures that load to database for easy entity relating and less DB redundant data.

Install
-------

Install bundle with `Composer` dependency manager first by running the command:

`$ composer require "lapalabs/currency-bundle:dev-master"`

Include
-------

Enable the bundle in application kernel for `prod` environment:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // other bundles...
        new LapaLabs\CurrencyBundle\LapaLabsCurrencyBundle(),
    );
}
```

Create your Currency class
--------------------------

``` php
<?php

namespace Acme\CurrencyBundle\Entity;

use LapaLabs\CurrencyBundle\Model\AbstractCurrency as BaseCurrency;
use Doctrine\ORM\Mapping as ORM;

/**
 * Currency
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Currency extends BaseCurrency
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
```

Create your Currency fixtures loader
------------------------------------

``` php
<?php

namespace Acme\CurrencyBundle\DataFixtures\ORM;

use LapaLabs\CurrencyBundle\DataFixtures\ORM\AbstractLoadCurrencyData;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadCurrencyData
 */
class LoadCurrencyData extends AbstractLoadCurrencyData implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // $this->locale = 'uk'; // Preferred locale in which store data to DB (used locale from parameters.yml by default)
        $this->entityClass = \Acme\CurrencyBundle\Entity\Currency::class; // Your entity class name
        parent::load($manager);
    }
}
```

Update database schema
----------------------

``` bash
$ php app/console doctrine:schema:update --force
```

Load fixtures
-------------

``` bash
$ php app/console doctrine:fixtures:load
```

Congratulations!
----------------
You're ready to use it!
