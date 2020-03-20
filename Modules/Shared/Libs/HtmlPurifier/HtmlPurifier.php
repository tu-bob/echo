<?php


namespace Modules\Shared\Libs\HtmlPurifier;


class HtmlPurifier
{
    private \HTMLPurifier $purifier;

    public function __construct()
    {
        $config = \HTMLPurifier_Config::createDefault();
        $this->purifier = new \HTMLPurifier($config);
    }

    /**
     * @param string $html
     * @return string
     */
    public function cleanHtml(string $html)
    {
        return $this->purifier->purify($html);
    }

}
