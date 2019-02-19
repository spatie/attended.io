<?php

namespace App\Http\ViewModels\Components;

use Illuminate\Database\Eloquent\Model;
use League\ISO3166\ISO3166;
use Spatie\BladeX\ViewModel;

class CountrySelectViewModel extends ViewModel
{
    /** @var string */
    public $name;

    /** @var null|\Illuminate\Database\Eloquent\Model */
    public $model;

    /** @var array */
    public $countries;

    public function __construct(string $name, Model $model)
    {
        $this->name = $name;

        $this->model = $model;

        $this->countries = collect((new ISO3166())->all())
            ->mapWithKeys(function (array $countryProperties) {
                return [$countryProperties['alpha2'] => $countryProperties['name']];
            })
            ->toArray();
    }

    public function isSelected(string $countryCode): bool
    {
        return formValue($this->name, $this->model) === $countryCode;
    }
}
