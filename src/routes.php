<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::get('sms', 'Nerdbrygg\SimpleSMS\Controllers\SmsController@create')->name('sms.create');
    Route::post('sms/send', 'Nerdbrygg\SimpleSMS\Controllers\SmsController@store')->name('sms.store');
});
