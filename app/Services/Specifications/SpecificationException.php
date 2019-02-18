<?php

namespace App\Services\Specifications;

use Exception;
use Illuminate\Contracts\Support\Responsable;

abstract class SpecificationException extends Exception implements Responsable
{
    public function toResponse($request)
    {
        flash()->error($this->getMessage());

        return back();
    }
}
