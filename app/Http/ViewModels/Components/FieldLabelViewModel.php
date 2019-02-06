<?php

namespace App\Http\ViewModels\Components;

use Spatie\BladeX\ViewModel;

class FieldLabelViewModel extends ViewModel
{
    /** @var string */
    public $for;

    /** @var string */
    public $label;

    public function __construct(string $for, string $label = '')
    {
        $this->for = $for;

        $this->label = $label === ''
            ? $this->formatToLabel($for)
            : $label;
    }

    protected function formatToLabel($value): string
    {
        $label = ucfirst($value);

        $label = str_replace('_', ' ', $label);

        return $label;
    }
}
