<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{__('Booking Confirmation!')}} | Luefty</title>
        <meta name="description" content="Luefty notification">
    </head>
    <body style="background-color:rgb(241,245,249); padding-top: 30px; padding-bottom: 30px; font-family:-apple-system,BlinkMacSystemFont,&quot;Segoe UI&quot;,Roboto,&quot;Helvetica Neue&quot;,Ubuntu,sans-serif;">
        
        <div style="max-width: 800px; min-width: 600px; margin: auto; background-color: #fff;">
            <!--Logo-->
            <div style="background-color: #007BFF; padding: 20px; text-align: center; border-top-left-radius: 3px; border-top-right-radius: 3px;">
                <img class="mb-2" src="https://luefty.com/images/logo-white.png" alt="" height="40">
            </div>
            
            <!--Body-->
            <div style="padding-left: 20px; padding-right: 20px; min-height: 300px; margin-bottom: 20px; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
                <div style="color:rgb(50,50,93); font-size:24px;line-height:32px; text-align: center; padding: 10px;">{{__('Booking Confirmation!')}}</div>
                
                <div style="color:rgb(136,152,170);font-size:15px;line-height:18px; text-align: center;">{{__('Booking ID')}}: # {{ $msg->auction_id }}</div>
                
                <div style="margin-top: 20px; margin-bottom: 10px; border-bottom: 1px solid #f1f1f1;">
                    <span style="font-size: 18px; line-height: 24px; color: #007BFF; font-weight: bold;">{{__('Booking Details')}}</span>
                </div>
                
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
                        </tr>
                    </tbody>
                </table>
                
                <table style="width: auto; margin-bottom: 25px; ">
                    <tbody>
                        <tr>
                            <td style="padding-right: 30px;">
                                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Passengers')}}</span> <br>
                                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $msg->passengers }}</span>
                            </td>
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

            </div>
            
        </div>
        
        <!--Invoice-->
        
        <div style="max-width: 800px; min-width: 600px; margin: auto; background-color: #fff;">
            
            <!--Body-->
            <div style="padding-left: 20px; padding-right: 20px; margin-bottom: 20px; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
                <div style="color:rgb(50,50,93); font-size:24px;line-height:32px; padding: 10px; border-bottom: 1px solid #f1f1f1;">{{__('Invoice')}}</div>
                
               <table style="width: auto; margin-bottom: 25px; ">
                    <tbody>
                        <!--Vehicle-->
                        <tr style="padding-bottom: 20px;">
                            {{-- <td style="padding-right: 30px; padding-top: 15px; border-bottom: 1px solid #f1f1f1; margin-bottom: 15px;">
                                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold; text-transform:uppercase;">Vehicle</span> <br>
                                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;">
                                    {{__('Vehicle type')}}
                                </span>
                            </td> --}}
                            <td style="padding-right: 30px; padding-top: 15px; border-bottom: 1px solid #f1f1f1;" valign="top">
                                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold; text-transform:uppercase;">${{ number_format($msg->order_total, 2, '.', ',') }}</span> <br>
                                
                            </td>
                        </tr>
                        
                        <!--Extras-->
                        @if ($msg->extras->count() > 0)
                        <tr style="border-bottom: 1px solid #f1f1f1;">
                            <td style="padding-right: 30px; padding-top: 15px; border-bottom: 1px solid #f1f1f1;">
                                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold; text-transform:uppercase;">{{__('Extras')}}</span> <br>
                                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;">
                                    @foreach($msg->extras as $extra) 
                                        <span>{{ $extra->quantity }} - {{ $extra->name }} = ${{ number_format($extra->total, 2, '.', ',') }}</span> <br>
                                    @endforeach
                                </span>
                            </td>
                            <td style="padding-right: 30px; padding-top: 15px; border-bottom: 1px solid #f1f1f1;" valign="top">
                                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold; text-transform:uppercase;">${{ number_format($msg->extras->sum('total'), 2, '.', ',') }}</span> <br>
                                
                            </td>
                        </tr>
                        @endif
                        
                        {{-- Total --}}
                         <tr style="border-bottom: 1px solid #f1f1f1;">
                            <td style="padding-right: 30px; padding-top: 15px; border-bottom: 1px solid #f1f1f1;">
                                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold; text-transform:uppercase;">TOTAL</span> <br>
                            </td>
                            <td style="padding-right: 30px; padding-top: 15px; border-bottom: 1px solid #f1f1f1;" valign="top">
                                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold; text-transform:uppercase;">${{ number_format($msg->order_total + $msg->extras->sum('total'), 2, '.', ',') }}</span> <br>
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                
            </div>
            
            <!--Footer-->
            <div style="padding: 15px; text-align: center; border-top: 1px solid #f1f1f1; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
                <img class="" src="https://luefty.com/images/logo.png" alt="" height="20">
                <div style="color:rgb(82,95,127); font-size:11px;line-height:14px; padding: 5px;">© {{ date('Y')}} All Rights Reserved | Luefty GmbH, Vienna, Austria | Patent Pending  </div>
            
            </div>
            
        </div>
        
    </body>
</html>