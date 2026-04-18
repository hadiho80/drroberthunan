<?php

namespace App\Support;

class CmsRichText
{
    public static function render(?string $value): string
    {
        if (! $value) {
            return '';
        }

        return strip_tags($value, '<strong><b><em><i><br><a>');
    }
}
