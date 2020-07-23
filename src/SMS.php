<?php

namespace Nerdbrygg\SimpleSMS;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    protected $table = 'simplemessages';

    protected $fillable = ['source', 'destination', 'message', 'status'];
}
