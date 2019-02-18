<?php

namespace App\Services\BusinessRules;

use Exception;
use Illuminate\Contracts\Support\Responsable;

abstract class BusinessRuleException extends Exception implements Responsable
{
    public function toResponse($request)
    {
        flash()->error($this->getMessage());

        return back();
    }
}
