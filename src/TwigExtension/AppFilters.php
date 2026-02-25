<?php

namespace App\TwigExtension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppFilters extends AbstractExtension
{

    public function getFilters(): array
    {
        return [
            new TwigFilter('convertToCamelCase', $this->convertToCamelCase(...)),
        ];
    }

    public function convertToCamelCase(string $text): string
    {
        // Replace non-alphanumeric characters with space
        $text = preg_replace('/[^a-zA-Z0-9]+/', ' ', $text);

        // Convert to lowercase
        $text = strtolower($text);

        // Uppercase first letter of each word
        $text = ucwords($text);

        // Remove spaces
        return str_replace(' ', '', $text);
    }
}
