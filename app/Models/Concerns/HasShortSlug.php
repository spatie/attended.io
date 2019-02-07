<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasShortSlug
{
    public static function bootHasShortSlug()
    {
        static::creating(function (Model $model) {
            do {
                $shortSlug = Str::lower(Str::random(6));
            } while (! is_null(static::findByShortSlug($shortSlug)));

            $model->short_slug = str_slug($shortSlug);
        });
    }

    public static function findByShortSlug(string $shortSlug): ?self
    {
        return static::where('short_slug', strtolower($shortSlug))->first();
    }
}
