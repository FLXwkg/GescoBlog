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
        $files = $this->getFileName();

        if (is_string($files)) {
            $files = [$files];
        }

        $scriptTags = '';
        foreach ($files as $file) {
            $scriptTags .= '<script src="/assets/js/' . $file . '"></script>';
        }

        return $scriptTags;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string|array $fileName
     * @return Script
     */
    public function setFileName($fileName): Script
    {
        if (is_array($fileName)) {
            // Handle an array of filenames
            $this->fileName = $fileName;
        } elseif (is_string($fileName)|| is_null($fileName)) {
            // Handle a single filename
            $this->fileName = [$fileName];
        } else {
            throw new \InvalidArgumentException('Invalid argument type for fileName');
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function __invoke($fileName = null)
    {
        if (is_null($fileName)) {
            return $this;
        }

        if (is_string($fileName)) {
            $this->setFileName([$fileName]); // Convert to array
        } elseif (is_array($fileName)) {
            $this->setFileName($fileName);
        } else {
            throw new \InvalidArgumentException('Invalid argument type for fileName');
        }

        return $this;
    }


}