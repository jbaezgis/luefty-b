@extends('layouts.app2')

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h4 class="box-title">{{ __('Your contact information')}} </h4>
                </div>{{-- /box-header --}}
                <div class="box-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td width="30%">{{ __('Full name')}}</td>
                                <td><strong>{{ $auction->full_name}}</strong></td>
                            </tr>
                            <tr>
                                <td>{{ __('Email')}}</td>
                                <td><strong>{{ $auction->email}}</strong></td>
                            </tr>
                            <tr>
                                <td>{{ __('Phone')}}</td>
                                <td><strong>{{ $auction->phone}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>{{-- /box-body --}}
            </div>{{-- /box --}}

            <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">{{ __('Arrival information')}} </h4>
                    </div>{{-- /box-header --}}
                    <div class="box-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td width="30%">{{ __('Arrival Date')}}</td>
                                    <td><strong>{{ date('l, F j - Y', strtotime($auction->date)) }} </strong></td>
                                </tr>
                                <tr>
                                    <td>{{ __('Arrival Airline')}}</td>
                                    <td><strong>{{ $auction->arrival_airline}}</strong></td>
                                </tr>
                                <tr>
                                    <td>{{ __('Flight Number')}}</td>
                                    <td><strong>{{ $auction->flight_number}}</strong></td>
                                </tr>
                                <tr>
                                    <td>{{ __('Arrival Time')}}</td>
                                    <td><strong>{{ date('g:i A', strtotime($auction->arrival_time)) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>{{-- /box-body --}}
                </div>{{-- /box --}}
        </div>{{-- /col --}}

        <div class="col-md-6">
            <div class="box box-solid box-primary">
                <div class="box-header">
                    <h4 class="box-title">{{ __('Booking details') }} </h4>
                </div>{{-- /box-header --}}
                <div class="box-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td width="30%">{{ __('From')}}</td>
                                <td><strong>{{ $auction->from->name }}</strong></td>
                            </tr>
                            <tr>
                                <td>{{ __('To')}}</td>
                                <td><strong>{{ $auction->to->name}}</strong></td>
                            </tr>
                            {{-- <tr>
                                <td>{{ __('Type')}}</td>
                                <td><strong>{{ $auction->typename->name}}</strong></td>
                            </tr> --}}
                            {{-- <tr>
                                <td>{{ __('Arrival Time')}}</td>
                                <td><strong>{{ $booking->time}}</strong></td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>{{-- /box-body --}}
                <div class="box-footer">
                    <h4>Total Fare: $ 0.00</h4>
                </div>{{-- /box-footer --}}
            </div>{{-- /box --}}
        </div>{{-- /col --}}
    </div>{{-- /row --}}
</div> {{-- /container --}}

@endsection
