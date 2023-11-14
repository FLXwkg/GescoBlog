<?php


namespace App\Support\Helper;


class TruncateText extends AbstractHelper
{

    /**
     * @var string
     */
    protected $text = '';

    /**
     * @var string
     */
    protected $href = '';

    /**
     * @var int
     */
    protected $maxLength = 140;

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        $text = $this->text;
        $maxLength = $this->maxLength;
        $content =  '<span class="truncated-text">' . substr($text, 0, $maxLength) . '...</span>';
        if (strlen($text) > $maxLength){
            return <<<HTML
                $content
                <a class="article-link" href="$this->href" >Voir plus</a>
                HTML;
        }
        return <<<HTML
                <span class="non-truncated-text">$text</span>
                HTML;
    }



    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return TruncateText
     */
    public function setText(string $text): TruncateText
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return TruncateText
     */
    public function setHref(string $href): TruncateText
    {
        $this->href = $href;
        return $this;
    }

        /**
     * @return string
     */
    public function getMaxLength(): string
    {
        return $this->maxLength;
    }

    /**
     * @param string $maxLength
     * @return TruncateText
     */
    public function setMaxLength(string $maxLength): TruncateText
    {
        $this->maxLength = $maxLength;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(?string $text = null, ?string $href = null, ?int $maxLength = 140)
    {
        if (!is_null($text)) {
            $this->setText($text);
        }
        if (!is_null($href)) {
            $this->setHref($href);
        }
        if (!is_null($maxLength)) {
            $this->setMaxLength($maxLength);
        }
        return $this;
    }


}