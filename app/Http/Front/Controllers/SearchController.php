<?php

namespace App\Http\Front\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController
{
    public function __invoke(Request $request)
    {
        $query = $request->get('query');

        $searchResults = (new Search())
            ->registerModel(Event::class, 'name')
            ->search($query);

        return view('front.search', compact('searchResults', 'query'));
    }
}
