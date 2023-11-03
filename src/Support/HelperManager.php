<?php


namespace App\Support;


use App\Configuration;
use App\Support\Helper\AbstractHelper;
use App\Support\Helper\Footer;
use App\Support\Helper\Header;
use App\Support\Helper\HeadTitle;
use App\Support\Helper\Breadcrumb;
use App\Support\Helper\Script;


class HelperManager
{

    /**
     * @var string[]
     */
    protected $invokables = [
        'script' => Script::class,
        'title' => HeadTitle::class,
        'header' => Header::class,
        'breadcrumb' => Breadcrumb::class,
        'footer' => Footer::class
    ];

    /**
     * @var AbstractHelper[]
     */
    protected $helpers = [];

    /**
     * @var TemplateFactory
     */
    protected $templateFactory;

    /**
     * @var Configuration|null
     */
    protected $configuration;


    /**
     * HelperManager constructor.
     * @param TemplateFactory|null $templateFactory
     * @param Configuration|null $configuration
     */
    public function __construct(?TemplateFactory $templateFactory = null, Configuration $configuration = null)
    {
        if (!is_null($templateFactory)) {
            $this->setTemplateFactory($templateFactory);
        }
        if (!is_null($configuration)) {
            $this->setConfiguration($configuration);
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $helper = $this->getHelper($name);
        return $helper(...$arguments);
    }

    /**
     * @param string $name
     * @return AbstractHelper
     */
    public function getHelper(string $name): AbstractHelper
    {
        if (!array_key_exists($name, $this->invokables)) {
            throw new \InvalidArgumentException();
        }
        if (!array_key_exists($name, $this->helpers)) {
            $class = $this->invokables[$name];
            /** @var AbstractHelper $helper */
            $helper = new $class();
            $helper->setManager($this);
            $this->helpers[$name] = $helper;
        }
        return $this->helpers[$name];
    }

    /**
     * @return TemplateFactory
     */
    public function getTemplateFactory(): TemplateFactory
    {
        return $this->templateFactory;
    }

    /**
     * @param TemplateFactory $templateFactory
     * @return HelperManager
     */
    public function setTemplateFactory(TemplateFactory $templateFactory): HelperManager
    {
        $this->templateFactory = $templateFactory;
        return $this;
    }

    /**
     * @return Configuration|null
     */
    public function getConfiguration(): ?Configuration
    {
        return $this->configuration;
    }

    /**
     * @param Configuration|null $configuration
     * @return HelperManager
     */
    public function setConfiguration(?Configuration $configuration): HelperManager
    {
        $this->configuration = $configuration;
        return $this;
    }


}