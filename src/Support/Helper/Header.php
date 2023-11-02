<?php

namespace App\Support\Helper;

use App\Categorie;
use Slim\Psr7\Request;

class Header extends AbstractHelper
{

    protected array $sections = [];

    protected Request $request;

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        $sectionsHtmlContent = $this->getSectionsHtmlContent();

        return <<<HTML
                    <header class="blog-header">
                        <div class="row container-fluid mx-0 px-0">
                            <div class="blog-header-logo col-2 pt-4 px-4 pb-2">
                                <a href="/">
                                    <img src="/images/logo.png" alt="FLX Logo" class="logo">
                                </a>
                            </div>
                            <div class="col-8 container mx-0">
                                <div class="row py-3">
                                    <div class="row blog-top pb-2">
                                        <div class="col-lg-0 col-xl-4 space-col"></div>
                                        <div class="col-lg-4 col-xl-4 blog-header-title text-center">
                                            <a href="/">
                                                <img src="/images/favicon.ico" alt="FLX Blog">
                                            </a>
                                        </div>
                                        <div class="col-lg-8 col-xl-4 search">
                                            <form class="row" role="search">
                                                <input class="col-9 search-input rounded" type="search" placeholder="Search" id="Search" aria-label="Search">
                                                <button class="col-3 btn btn-outline-secondary" type="submit">Search</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="nav row">
                                        <nav class="navbar navbar-expand-lg py-1">
                                            <div class="container-fluid d-flex justify-content-evenly">
                                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" 
                                                        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                                                    <span class="navbar-toggler-icon"></span>
                                                </button>
                                                <div class="collapse navbar-collapse justify-content-evenly"  id="navbarTogglerDemo01">
                                                $sectionsHtmlContent
                                                </div>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2"></div>   
                        </div>
                    </header>
                HTML;
    }


    protected function getSectionsHtmlContent(): string
    {
        $html = '';
        $currentUrl = $this->request->getUri()->getPath();

        /** @var Categorie $section */
        foreach ($this->sections as $section) {
            $url = '/' . $section->getSlug();
            $isActive = $currentUrl === $url;
            $activeClass = $isActive ? ' active' : '';
            $label = $section->getNom() ?? 'indéfini';
            $html .= '<a class="nav-link p-2'.$activeClass.'" href="' . $url . '">' . $label . '</a>';
        }
        return $html;
    }


    /**
     * @inheritDoc
     */
    public function __invoke(array $sections = [], ?Request $request = null)
    {
        $this->sections = $sections;
        $this->request = $request;
        return $this;
    }
}