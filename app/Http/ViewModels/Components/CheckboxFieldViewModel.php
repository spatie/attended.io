<?php

namespace App\Http\ViewModels\Components;

use Illuminate\Database\Eloquent\Model;
use Spatie\BladeX\ViewModel;

class CheckboxFieldViewModel extends ViewModel
{
    /** @var string */
    public $name;

    /** @var null|\Illuminate\Database\Eloquent\Model */
    protected $model;

    /** @var null|string */
    protected $modelField;

    public function __construct(string $name, ?Model $model = null, ?string $modelField = null)
    {
        $this->name = $name;

        $this->model = $model;

        $this->modelField = $modelField ?? $name;
    }

    public function isChecked(): bool
    {
        return formValue($this->name, $this->model, $this->modelField) ?? false;
    }
}
