<?php


namespace Application\Support\Helper;


use Application\Support\HelperManager;

abstract class AbstractHelper
{

    /**
     * @var HelperManager
     */
    protected $manager;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getContent();
    }

    /**
     * @return string
     */
    abstract public function getContent(): string;

    /**
     * @return mixed
     */
    abstract public function __invoke();

    /**
     * @return HelperManager
     */
    public function getManager(): HelperManager
    {
        return $this->manager;
    }

    /**
     * @param HelperManager $manager
     * @return AbstractHelper
     */
    public function setManager(HelperManager $manager): AbstractHelper
    {
        $this->manager = $manager;
        return $this;
    }

}