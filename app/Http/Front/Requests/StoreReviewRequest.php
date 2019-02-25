<?php

namespace App\Http\Front\Requests;

use App\Domain\Review\Interfaces\Reviewable;
use App\Domain\Review\Rules\ReviewableType;
use App\Domain\Review\Specifications\CanBeReviewed;
use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorized()
    {
        return $this->user()->can('review', $this->reviewable());
    }

    public function rules()
    {
        return [
            'reviewable_type' => ['required', new ReviewableType()],
            'reviewable_id' => 'required|integer',
            'rating' => 'min:1|max:6',
            'remarks' => '',
        ];
    }

    public function reviewable(): Reviewable
    {
        return $this->reviewable_type::find($this->reviewable_id);
    }
}
