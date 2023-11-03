<?php


namespace App\Support\Helper;


class Script extends AbstractHelper
{

    /**
     * @var string
     */
    protected $fileName = '';


    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return '<script src="/assets/js/' . $this->getFileName() . '"></script>';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $thisPageTitle
     * @return Script
     */
    public function setFileName(string $fileName): Script
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(?string $fileName = null)
    {
        if (!is_null($fileName)) {
            $this->setFileName($fileName);
        }
        return $this;
    }


}