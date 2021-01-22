<?php

namespace Nerdbrygg\SimpleSMS\Controllers;

use Illuminate\Routing\Controller;
use Nerdbrygg\SimpleSMS\SimpleSMS;

class SmsController extends Controller
{
    /**
     * Send the SMS and store it in a database.
     */
    public function store()
    {
        SimpleSMS::create(request()->validate([
            'source' => 'nullable',
            'destination' => 'required',
            'message' => 'required',
        ]))->send();

        return redirect()->back();
    }
}
