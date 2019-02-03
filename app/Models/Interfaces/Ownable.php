<?php

namespace App\Models\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface Ownable
{
    public function owners(): MorphToMany;

    public function pendingOwners(): MorphToMany;
}