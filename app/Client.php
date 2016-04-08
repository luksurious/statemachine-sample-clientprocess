<?php

namespace App;

use MetaborStd\Statemachine\StateInterface;

class Client
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var StateInterface
     */
    protected $state;

    /**
     * @var \DateTime
     */
    protected $contractStartDate;

    /**
     * @var bool
     */
    protected $signed;

    /**
     * @return string
     */
    function __toString()
    {
        return (string) $this->name;
    }

    /**
     * @return bool
     */
    public function isContractActive()
    {
        return $this->signed
            && $this->contractStartDate instanceof \DateTime
            && $this->contractStartDate < new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getContractStartDate()
    {
        return $this->contractStartDate;
    }

    /**
     * @param mixed $contractStartDate
     */
    public function setContractStartDate($contractStartDate)
    {
        $this->contractStartDate = $contractStartDate;
    }
}
