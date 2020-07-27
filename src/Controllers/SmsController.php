<?php

namespace Nerdbrygg\SimpleSMS\Controllers;

use Illuminate\Routing\Controller;
use Nerdbrygg\SimpleSMS\Facades\SimpleSMS;
use Nerdbrygg\SimpleSMS\SMS;

class SmsController extends Controller
{
    /**
     * Return send-sms view.
     */
    public function create()
    {
        return view('nerdbrygg::create');
    }

    /**
     * Send the SMS and store it in a database.
     */
    public function store()
    {
        if (config('simplesms.messages.save')) {
            $attributes = request()->validate([
                'source' => 'sometimes',
                'destination' => 'required',
                'message' => 'required',
            ]);

            $response = SimpleSMS::to($attributes['destination'])->message($attributes['message'])->send();

            $attributes['status'] = $response->getReasonPhrase();

            if (config('simplesms.messages.encryption')) {
                $attributes['message'] = encrypt($attributes['message']);
            }

            SMS::create($attributes);
        }

        return back();
    }
}
