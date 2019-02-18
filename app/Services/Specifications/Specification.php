<?php

namespace App\Services\Specifications;

abstract class Specification
{
    abstract public function ensure();

    public function passes(): bool
    {
        try {
            $this->ensure();

            return true;
        } catch (SpecificationException $exception) {
            return false;
        }
    }
}
