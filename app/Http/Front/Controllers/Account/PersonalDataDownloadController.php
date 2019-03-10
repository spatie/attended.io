<?php

namespace App\Http\Front\Controllers\Account;

use Spatie\PersonalDataExport\Jobs\CreatePersonalDataExportJob;

class PersonalDataDownloadController
{
    public function index()
    {
        return view('front.account.personal-data-download');
    }

    public function create()
    {
        dispatch(new CreatePersonalDataExportJob(auth()->user()));

        flash()->message("We are preparing your download. We'll send send you a link as soon as the download is ready.");

        return back();
    }
}
