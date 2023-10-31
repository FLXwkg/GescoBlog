<?php


namespace Application\Support\Helper;


class HeadTitle extends AbstractHelper
{

    /**
     * @var string
     */
    protected $headTitle = '';


    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->getHeadTitle();
    }

    /**
     * @return string
     */
    public function getHeadTitle(): string
    {
        return $this->headTitle;
    }

    /**
     * @param string $headTitle
     * @return HeadTitle
     */
    public function setHeadTitle(string $headTitle): HeadTitle
    {
        $this->headTitle = $headTitle;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(?string $headTitle = null)
    {
        if (!is_null($headTitle)) {
            $this->setHeadTitle($headTitle);
        }
        return $this;
    }


}