<?php

namespace App\Support\Helper;

class Footer extends AbstractHelper
{

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return <<<HTML
                    <footer class="blog-footer py-5 mt-2">
                        <p>Blog built by <a href="https://github.com/FLXwkg" target="_blank">FLX</a>.</p>
                        <p class="mb-0">
                            <a href="#">Back to top</a>
                        </p>
                    </footer>
                HTML;
    }

    /**
     * @inheritDoc
     */
    public function __invoke()
    {
        return $this;
    }
}