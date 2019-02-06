<?php

namespace App\Providers;

use App\Http\ViewModels\Components\CheckboxFieldViewModel;
use App\Http\ViewModels\Components\FieldLabelViewModel;
use App\Http\ViewModels\Components\FormErrorViewModel;
use Illuminate\Support\ServiceProvider;
use Spatie\BladeX\Facades\BladeX;

class BladeXServiceProvider extends ServiceProvider
{
    public function boot()
    {
        BladeX::component('front.components.*');
        BladeX::component('front.components.fieldLabel')->viewModel(FieldLabelViewModel::class);
        BladeX::component('front.components.formError')->viewModel(FormErrorViewModel::class);
        BladeX::component('front.components.checkboxField')->viewModel(CheckboxFieldViewModel::class);
    }
}
