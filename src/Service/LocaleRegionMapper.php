<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class LocaleRegionMapper
{
    private array $mapping = [
        'fr' => 'FR',
        'en' => 'US',
        'es' => 'ES',
    ];

    function __construct(private readonly RequestStack $requestStack) {}

    function getRegion(string $locale = null) {
        if (!$locale) {
            $locale = $this->requestStack->getCurrentRequest()->getLocale();
        }
        return $this->mapping[$locale] ?? null ;
    }
}
