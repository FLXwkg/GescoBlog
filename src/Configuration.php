<?php


namespace App;


class Configuration
{

    /**
     * @var array
     */
    protected $configuration = [];


    /**
     * Configuration constructor.
     * @param array $configuration
     */
    public function __construct(array $configuration = [])
    {
        $this->setConfiguration($configuration);
    }

    /**
     * @return array
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    /**
     * @param array $configuration
     * @return Configuration
     */
    public function setConfiguration(array $configuration): Configuration
    {
        $this->configuration = $configuration;
        return $this;
    }


}