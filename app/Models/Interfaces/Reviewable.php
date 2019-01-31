<?php

namespace App\Models\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Reviewable
{
    public function reviews(): MorphMany;

    public function recalculateSummary();
}