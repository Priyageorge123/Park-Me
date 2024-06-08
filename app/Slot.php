<?php

namespace App;

class Slot extends Model
{
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
