<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;

trait Sluggable
{
    public static function bootSluggable()
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
