<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = ['username','email','message']; //kerektuu ozgormolordu chakyruu

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('H:i:s / d-m-Y'); //saattyn formatyn kotoruu
    }
}
