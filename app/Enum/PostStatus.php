<?php

namespace App\Enum;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PostStatus: string implements HasLabel, HasColor 
{
    case DRAFT = 'draft';
    case UNPUBLISHED = 'unpublished';
    case PUBLISHED = 'published';

    public function getLabel(): ?string
    {
        return match($this){
            static::DRAFT => __('Draft'),
            static::UNPUBLISHED => __('Unpublished'),
            static::PUBLISHED => __('Published')
        };
    }

    public function getColor(): string|array|null
    {
        return match($this) {
            static::DRAFT => 'gray', // gray
            static::UNPUBLISHED => 'danger', // red
            static::PUBLISHED => 'success' // green
        };
    }
}