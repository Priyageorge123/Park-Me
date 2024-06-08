@extends('layouts.app')

@section('content')
            <div>
                <h1 style="padding-left:80px"> Confirm your Booking!!</h1><br/>
                <p style="padding-left:80px;font-size:20px;">
                    Name: <i>{{ auth()->user()->name }}</i><br/>
                    Vehicle id: <i>{{ auth()->user()->vehicle_no }}</i><br/>
                    Email: <i>{{ auth()->user()->email }}</i><br/>
                    Booked Slot: <i>{{ $booking->area }} - {{ $booking->slot }}</i><br/>
                <form style="padding-left:80px;" method="POST" action="/booking/{{ $booking->id }}/store">
                    @csrf
                    <select class="custom-select" style="width: 200px; height: 30px" name="validity">
                        <option value="1">Day Pass @ Rs 49</option>
                        <option value="30">Month Pass @ Rs 499</option>
                    </select>
                    <br><br>
                    <input style="width: 180px; height: 60px; font-size: 28px" type="submit" value="Pay">
                </form>
                <hr>
                <br />
            </div>
@endsection
