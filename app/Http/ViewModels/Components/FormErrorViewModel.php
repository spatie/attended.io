<?php

namespace App\Http\ViewModels\Components;

use Spatie\BladeX\ViewModel;

class FormErrorViewModel extends ViewModel
{
    /** @var string */
    public $fieldName;

    public function __construct(string $fieldName)
    {
        $this->fieldName = preg_replace('/\[(.+)\]/U', '.$1', $fieldName);
    }
}
