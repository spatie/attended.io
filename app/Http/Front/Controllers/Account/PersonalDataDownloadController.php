<?php

namespace App\Http\Front\Controllers\Account;

use Spatie\PersonalDataDownload\Jobs\CreatePersonalDataDownloadJob;

class PersonalDataDownloadController
{
    public function index()
    {
        return view('front.account.personal-data-download');
    }

    public function create()
    {
        dispatch(new CreatePersonalDataDownloadJob(auth()->user()));

        flash()->message("We are preparing your download. We'll send send you a link as soon as the download is ready.");

        return back();
    }


}