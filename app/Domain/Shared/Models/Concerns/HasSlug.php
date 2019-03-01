<?php

namespace App\Domain\Shared\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::saving(function (Model $model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function idSlug(): string
    {
        return "{$this->id}-{$this->slug}";
    }
}
