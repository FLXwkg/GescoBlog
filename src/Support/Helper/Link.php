<?php


namespace App\Support\Helper;


class Link extends AbstractHelper
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
        return '<link href="/assets/css/' . $this->getFileName() . '" rel="stylesheet">';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return Link
     */
    public function setFileName(string $fileName): Link
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