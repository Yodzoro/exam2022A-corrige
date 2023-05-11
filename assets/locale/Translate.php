<?php

class Translate
{
    private string $locale;
    private array $translations;

    public function __construct(string $locale)
    {
        $this->locale = $locale;
        require_once __DIR__ . "/" . ($locale === 'en' ? 'en' : 'fr') . ".php";
        $this->translations = $trad;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function getTrad(string $key): string
    {
        $keys = explode('.', $key);
        $trad = $this->translations;
        foreach ($keys as $key) {
            $trad = $trad[$key];
        }
        return $trad ?? '';
    }
}