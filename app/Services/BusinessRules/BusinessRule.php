<?php

namespace App\Services\BusinessRules;

abstract class BusinessRule
{
    abstract public function ensure();

    public function passes(): bool
    {
        try {
            $this->ensure();

            return true;
        } catch (BusinessRuleException $exception) {
            return false;
        }
    }
}
