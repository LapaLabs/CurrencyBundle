<?php

namespace LapaLabs\CurrencyBundle\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractCurrency
 */
abstract class AbstractCurrency
{
    protected $id;

    /**
     * The arbitrary currency name
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * The currency ISO 4217 code
     *
     * @var string
     *
     * @ORM\Column(type="string", length=3, unique=true)
     */
    protected $code;

    /**
     * The currency symbol
     *
     * @var string
     *
     * @ORM\Column(type="string", length=3)
     */
    protected $sign;

    /**
     * The exchange rate
     *
     * @var float
     *
     * @ORM\Column(type="decimal", precision=10, scale=5)
     */
    protected $rate = 1;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $published = true;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return AbstractCurrency
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return AbstractCurrency
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set sign
     *
     * @param string $sign
     * @return AbstractCurrency
     */
    public function setSign($sign)
    {
        $this->sign = $sign;

        return $this;
    }

    /**
     * Get sign
     *
     * @return string 
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * Set rate
     *
     * @param float $rate
     * @return AbstractCurrency
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set published
     *
     * @param float $published
     * @return AbstractCurrency
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return float
     */
    public function isPublished()
    {
        return $this->published;
    }
}
