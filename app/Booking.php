<?php

namespace App;

class Booking extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }
}
