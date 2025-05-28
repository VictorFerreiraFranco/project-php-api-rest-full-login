<?php

namespace Api\libraries\translator;

enum Lang
{
    case EN_US;
    
    case PT_BR;
    
    public function get(): string
    {
        return match ($this) {
            Lang::EN_US => 'en',
            Lang::PT_BR => 'pt'
        };
    }
    
    public static function fromString(string $lang): ?self
    {
        return match (strtolower($lang)) {
            'en' => self::EN_US,
            'pt' => self::PT_BR,
            default => null,
        };
    }
}
