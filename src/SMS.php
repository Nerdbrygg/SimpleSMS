<?php

namespace Nerdbrygg\SimpleSMS;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    protected $table = 'simplemessages';

    protected $guarded = [];
}
