@extends('layouts.app')

@section('content')
<h3 style="padding-left:80px">Your Details</h3><br />
<p style="padding-left:80px; font-size:20px;">
    Name: <strong>{{ auth()->user()->name }}</strong><br />
    Vehicle Id: <strong>{{ auth()->user()->vehicle_no }}</strong><br />
    Email: <strong>{{ auth()->user()->email }}</strong><br />
    Moodle Id: <strong>{{ auth()->user()->moodle }}</strong><br />
</p>
<br />

<hr>
<br />
<h3 style="padding-left:80px">Your Pass</h3><br />
<p style="padding-left:80px;font-size:20px;">
    @if($booking)
        <?php $carbon = new \Carbon\Carbon($booking->created_at); ?>
        @if($carbon->addDays($booking->validity) > \Carbon\Carbon::now())
            Slot: <strong>{{ $booking->slot->area }} - {{ $booking->slot->slot }}</strong><br>
            Valid till: <strong>{{ $carbon->toFormattedDateString() }}</strong><br>
            Valid from: <strong>{{ $carbon->subDays($booking->validity)->toFormattedDateString() }}</strong>
        @else
            <a href="/booking"><button type="button" class="btn btn-primary">Book</button></a>
        @endif
        <br>
    @else
        <a href="/booking"><button type="button" class="btn btn-primary">Book</button></a>
@endif
        <br />
<hr>
<br />

@endsection
