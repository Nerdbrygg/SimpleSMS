<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::post('sms/send', 'Nerdbrygg\SimpleSMS\Controllers\SmsController@store')->name('sms.store');
});
