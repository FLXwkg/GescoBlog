<?php


namespace Application\Support\Helper;


class Breadcrumb extends AbstractHelper
{

    /**
     * @var string[]
     */
    protected $parents = [];

    /**
     * @var string
     */
    protected $thisPageTitle = '';


    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        $urls = ['/' => 'Accueil'];
        $urls = array_merge($urls, $this->getParents());
        $html = '';
        foreach ($urls as $url => $title) {
            $html .= '<li class="breadcrumb-item"><a href="' . $url . '">' . $title . '</a></li>';
        }
        $html .= '<li class="breadcrumb-item active">' . $this->getThisPageTitle() . '</li>';
        return <<<HTML
    <nav class="article-category ps-5 py-2" aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
        <ol class="breadcrumb my-0">
            $html
        </ol>
    </nav>

HTML;


    }

    /**
     * @return string[]
     */
    public function getParents(): array
    {
        return $this->parents;
    }

    /**
     * @param string[] $parents
     * @return Breadcrumb
     */
    public function setParents(array $parents): Breadcrumb
    {
        $this->parents = $parents;
        return $this;
    }

    /**
     * @return string
     */
    public function getThisPageTitle(): string
    {
        return $this->thisPageTitle;
    }

    /**
     * @param string $thisPageTitle
     * @return Breadcrumb
     */
    public function setThisPageTitle(string $thisPageTitle): Breadcrumb
    {
        $this->thisPageTitle = $thisPageTitle;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(?array $parents = null, ?string $thisPageTitle = null)
    {
        if (!is_null($parents)) {
            $this->setParents($parents);
        }
        if (!is_null($thisPageTitle)) {
            $this->setThisPageTitle($thisPageTitle);
        }
        return $this;
    }


}