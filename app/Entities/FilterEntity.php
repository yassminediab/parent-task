<?php
namespace App\Entities;

use App\Adapter\IJsonReader;
use Illuminate\Support\Collection;

class FilterEntity  {

    /**
     * @var string
     */
    protected $provider;

    /**
     * @var string
     */
    protected $min_amount;

    /**
     * @var string
     */
    protected $max_amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var string
     */
    protected $statusCode;

    /**
     * @param $amount
     * @return $this
     */
    public function setMinAmount($amount)
    {
        $this->min_amount = $amount;
        return $this;
    }

    /**
     * @param $amount
     * @return $this
     */
    public function setMaxAmount($amount){
        $this->max_amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getMinAmount()
    {
        return $this->min_amount;
    }

    /**
     * @return string
     */
    public function getMaxAmount()
    {
        return $this->max_amount;
    }

    /**
     * @param $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }
}
