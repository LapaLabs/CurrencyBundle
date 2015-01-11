<?php

namespace LapaLabs\CurrencyBundle\DataFixtures\ORM;

use LapaLabs\CurrencyBundle\Model\AbstractCurrency;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Intl\Intl;

/**
 * Class AbstractLoadCurrencyData
 */
class AbstractLoadCurrencyData implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $entityClass;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $locale = $this->defineLocale();
        $currencies = Intl::getCurrencyBundle()->getCurrencyNames($locale);
        foreach ($currencies as $code => $name) {
            $currency = $this->createEntityClass();
            $currency->setName($name);
            $currency->setCode($code);
            $sign = Intl::getCurrencyBundle()->getCurrencySymbol($code, $locale);
            $currency->setSign($sign);
            $currency->setPublished(true);
            $manager->persist($currency);
        }

        $manager->flush();
    }

    /**
     * The locale
     *
     * @return string
     */
    private function defineLocale()
    {
        // use locale that manually set by user
        $locale = $this->locale;
        if (! $locale) {
            // use default locale from parameters.yml if not set
            $locale = $this->container->getParameter('locale');
        }

        return $locale;
    }

    /**
     * New entity object
     *
     * @return AbstractCurrency
     */
    private function createEntityClass()
    {
        if (! class_exists($this->entityClass)) {
            throw new \RuntimeException(sprintf(
                'You should specify the existing Currency class for load fixtures'
            ));
        }

        $entity = new $this->entityClass;

        if (! $entity instanceof AbstractCurrency) {
            throw new \RuntimeException(sprintf(
                'The Currency class should be extends from the %s',
                AbstractCurrency::class
            ));
        }

        return $entity;
    }
}
