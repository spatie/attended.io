<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::saving(function(Model $model) {
            $model->slug = str_slug($model->name);
        });
    }

    public function idSlug(): string
    {
        return "{$this->id}-{$this->slug}";
    }
}
