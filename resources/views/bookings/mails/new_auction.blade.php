<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Luefty</title>
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
                <div style="color:rgb(50,50,93); font-size:24px;line-height:32px; text-align: center; padding: 10px;">{{__('New auction created!')}}</div>
                
                <div style="color:rgb(136,152,170);font-size:15px;line-height:18px; text-align: center;">
                    {{__('Booking ID')}}: # {{ $msg->auction_id }} | 
                    {{__('Type')}}: 
                    @if ($msg->type == 'oneway')
                        {{__('One Way')}}
                    @else
                        {{__('Round Trip')}}
                    @endif
                </div>
                
                <div style="margin-top: 20px; margin-bottom: 10px; border-bottom: 1px solid #f1f1f1;">
                    <span style="font-size: 18px; line-height: 24px; color: #007BFF; font-weight: bold;">{{__('Booking Details')}}</span>
                </div>

                {{-- Airport to Airport --}}
                @if ($msg->fromcity->is_airport == 1 && $msg->tocity->is_airport == 1)
                    @include ('bookings.mails.types.airport_to_airport')
                {{-- Airport to Location --}}
                @elseif ($msg->fromcity->is_airport == 1 && $msg->tocity->is_airport == NULL)
                    @include ('bookings.mails.types.airport_to_location')
                {{-- Location to Location --}}
                @elseif ($msg->fromcity->is_airport == NULL && $msg->tocity->is_airport == NULL)
                    @include ('bookings.mails.types.location_to_location')
                {{-- Location to Airport --}}
                @elseif ($msg->fromcity->is_airport == NULL && $msg->tocity->is_airport == 1)
                    @include ('bookings.mails.types.location_to_airport')
                @endif
                
                <!--Extras-->
                <div style="margin-top: 20px; margin-bottom: 10px; border-bottom: 1px solid #f1f1f1;">
                    @if ($msg->extras->count() > 0)
                    <tr style="border-bottom: 1px solid #f1f1f1;">
                        <td style="padding-right: 30px; padding-top: 15px; border-bottom: 1px solid #f1f1f1;">
                            <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold; text-transform:uppercase;">{{__('Extras')}}</span> <br>
                            <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;">
                                @foreach($msg->extras as $extra) 
                                    <span>{{ $extra->quantity }} - {{ $extra->name }} = {{$msg->country->currency_symbol}}{{ number_format($extra->total, 2, '.', ',') }}</span> <br>
                                @endforeach
                            </span>
                        </td>
                        <td style="padding-right: 30px; padding-top: 15px; border-bottom: 1px solid #f1f1f1;" valign="top">
                            <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold; text-transform:uppercase;">${{ number_format($msg->extras->sum('total'), 2, '.', ',') }}</span> <br>
                            
                        </td>
                    </tr>
                    @endif
                </div>
            </div>
            
            <!--Footer-->
            <div style="padding: 15px; text-align: center; border-top: 1px solid #f1f1f1; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
                <img class="" src="https://luefty.com/images/logo.png" alt="" height="20">
                <div style="color:rgb(82,95,127); font-size:11px;line-height:14px; padding: 5px;">© {{ date('Y')}} All Rights Reserved | Luefty GmbH, Vienna, Austria | Patent Pending  </div>
            
            </div>
            
        </div>
        
    </body>
</html>