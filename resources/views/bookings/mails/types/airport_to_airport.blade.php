@if ($msg->type == 'roundtrip')
    <div style="margin-top: 20px; margin-bottom: 10px; border-bottom: 1px solid #f1f1f1;">
        <span style="font-size: 16px; line-height: 24px; color: #007BFF; font-weight: bold;">{{__('Going:')}}</span>
    </div>
@endif

<table style="width: auto; margin-bottom: 25px;">
    <tbody>
        <tr>
            <td style="padding-right: 30px;">
                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{ __('From') }}</span> <br>
                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->fromcity->name  }}</span>
            </td>
            <td style="padding-right: 30px;">
                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{ __('To') }}</span> <br>
                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->tocity->name  }}</span>
            </td>
            <td style="padding-right: 30px;">
                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Driving Time')}}</span> <br>
                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">
                    
                    @if ($msg->service->driving_time > 60)
                        {{date('H'.' \h\o\u\r\s \a\n\d '. 'i'.' \m\i\n\s', mktime(0,$msg->service->driving_time))}}
                    @else
                        {{date('i'.' \m\i\n\s', mktime(0,$msg->service->driving_time))}}
                    @endif
                </span>
            </td>
        </tr>
    </tbody>
</table>

<table style="width: auto; margin-bottom: 25px; ">
    <tbody>
        <tr>
            <td style="padding-right: 30px;">
                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Arrival Date')}}</span> <br>
                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->date }}</span>
            </td>
            <td style="padding-right: 30px;">
                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Arrival Airline')}}</span> <br>
                
                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->arrival_airline }}</span>
            </td>
            <td style="padding-right: 30px;">
                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Flight Number')}}</span> <br>
                
                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->flight_number }}</span>
            </td>
            <td style="padding-right: 30px;">
                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Arrival Time')}}</span> <br>
                
                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ date('g:i A', strtotime($msg->arrival_time)) }}</span>
            </td>
        </tr>
    </tbody>
</table>


<table style="width: auto; margin-bottom: 25px; ">
    <tbody>
        <tr>
            <td style="padding-right: 30px;">
                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('More Information')}}</span> <br>
                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->more_information }}</span>
            </td>
        </tr>
    </tbody>
</table>

@if ($msg->type == 'roundtrip')
    <div style="margin-top: 20px; margin-bottom: 10px; border-bottom: 1px solid #f1f1f1;">
        <span style="font-size: 16px; line-height: 24px; color: #007BFF; font-weight: bold;">{{__('Return:')}}</span>
    </div>

    <table style="width: auto; margin-bottom: 25px;">
        <tbody>
            <tr>
                <td style="padding-right: 30px;">
                    <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{ __('From') }}</span> <br>
                    <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->tocity->name }}</span>
                </td>
                <td style="padding-right: 30px;">
                    <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{ __('To') }}</span> <br>
                    <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->fromcity->name }}</span>
                </td>
                <td style="padding-right: 30px;">
                    <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Driving Time')}}</span> <br>
                    <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">
                        
                        @if ($msg->service->driving_time > 60)
                            {{date('H'.' \h\o\u\r\s \a\n\d '. 'i'.' \m\i\n\s', mktime(0,$msg->service->driving_time))}}
                        @else
                            {{date('i'.' \m\i\n\s', mktime(0,$msg->service->driving_time))}}
                        @endif
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: auto; margin-bottom: 25px; ">
        <tbody>
            <tr>
                
                <td style="padding-right: 30px;">
                    <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Arrival Date')}}</span> <br>
                    <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->return_date }}</span>
                </td>
                <td style="padding-right: 30px;">
                    <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Arrival Airline')}}</span> <br>
                    
                    <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->return_airline }}</span>
                </td>
                <td style="padding-right: 30px;">
                    <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Flight Number')}}</span> <br>
                    
                    <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->return_flight_number }}</span>
                </td>
                <td style="padding-right: 30px;">
                    <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Arrival Time')}}</span> <br>
                    
                    <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ date('g:i A', strtotime($msg->return_time)) }}</span>
                </td>
                {{-- <td style="padding-right: 30px;">
                    <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Pickup Time')}}</span> <br>
                    
                    <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ date('g:i A', strtotime($msg->pickup_time)) }}</span>
                </td> --}}
            </tr>
        </tbody>
    </table>
    
    
    <table style="width: auto; margin-bottom: 25px; ">
        <tbody>
            <tr>
                <td style="padding-right: 30px;">
                    <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('More Information')}}</span> <br>
                    <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->return_more_information }}</span>
                </td>
            </tr>
        </tbody>
    </table>

@endif

<table style="width: auto; margin-bottom: 25px;">
    <tbody>
        <tr>
            <td style="padding-right: 30px;">
                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Name')}}</span> <br>
                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->full_name }}</span>
            </td>
            <td style="padding-right: 30px;">
                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Email')}}</span> <br>
                
                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->email }}</span>
            </td>
            <td style="padding-right: 30px;">
                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Phone')}}</span> <br>
                
                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->phone }}</span>
            </td>
            <td style="padding-right: 30px;">
                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Passengers')}}</span> <br>
                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->passengers }}</span>
            </td>
        </tr>
    </tbody>
</table>