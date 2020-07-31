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
        $attributes = request()->validate([
            'source' => 'sometimes',
            'destination' => 'required',
            'message' => 'required',
        ]);

        if ($attributes['source'] == null) {
            $attributes['source'] = config('simplesms.default.source');
        }

        $response = SimpleSMS::to($attributes['destination'])
            ->message($attributes['message'])
            ->from($attributes['source'])
            ->send();

        if (config('simplesms.messages.save')) {
            $attributes['status'] = $response->getReasonPhrase();

            $attributes['user_id'] = (auth()->id() ?: null);

            if (config('simplesms.messages.encryption')) {
                $attributes['message'] = encrypt($attributes['message']);
            }

            SMS::create($attributes);
        }

        return redirect()->back();
    }
}
