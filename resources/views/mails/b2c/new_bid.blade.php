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
                <div style="color:rgb(50,50,93); font-size:24px;line-height:32px; text-align: center; padding: 10px;">{{__('New bid!')}}</div>
                
                <div style="margin-top: 20px; margin-bottom: 10px; border-bottom: 1px solid #f1f1f1;">
                    <span style="font-size: 18px; line-height: 24px; color: #007BFF; font-weight: bold;">{{__('Bid Details')}}</span>
                </div>

                @if ($bid->auction->type == 'roundtrip')
                    <div style="margin-top: 20px; margin-bottom: 10px; border-bottom: 1px solid #f1f1f1;">
                        <span style="font-size: 16px; line-height: 24px; color: #007BFF; font-weight: bold;">{{__('Going:')}}</span>
                    </div>
                @endif
                
                <table style="width: auto; margin-bottom: 25px;">
                    <tbody>
                        <tr>
                            <td style="padding-right: 30px;">
                                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{ __('From') }}</span> <br>
                                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $bid->auction->fromcity->name }}</span>
                            </td>
                            <td style="padding-right: 30px;">
                                <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{ __('To') }}</span> <br>
                                <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $bid->auction->tocity->name  }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                @if ($bid->auction->type == 'roundtrip')
                    <table style="width: auto; margin-bottom: 25px;">
                        <tbody>
                            <tr>
                                <td style="padding-right: 30px;">
                                    <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{ __('From') }}</span> <br>
                                    <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $bid->auction->tocity->name }}</span>
                                </td>
                                <td style="padding-right: 30px;">
                                    <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{ __('To') }}</span> <br>
                                    <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{ $bid->auction->fromcity->name  }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                
                <div style="margin-top: 20px; border-bottom: 1px solid #f1f1f1;">
                    <span style="font-size: 18px; line-height: 24px; color: #007BFF; font-weight: bold;">{{__('Bid Details')}}</span>
                </div>
                
                <div style="padding-top: 15px;">
                    <table style="width: auto;">
                        <tbody>
                            <tr>
                                <td style="padding-right: 30px;">
                                    <span style="color:rgb(136,152,170);font-size:12px;line-height:16px;white-space:nowrap;font-weight:bold;text-transform:uppercase;">{{__('Bid')}}</span> <br>
                                    <span style="color:rgb(82,95,127);font-size:16px;line-height:16px;white-space:nowrap;font-weight:bold;">{{$bid->auction->country->currency_symbol}}{{ number_format($bid->bid, 2, '.', ',') }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="padding-top: 15px;">
                    <p style="color:rgb(82,95,127);">
                        {{__('Make your bid and you will have a chance to win this auction!')}} 
                    </p>
                </div>

                <div style="margin-top: 20px; margin-bottom: 10px; padding-top: 15px;">
                    <a href="{{setting('main-url')}}/suppliers/auction/{{ $bid->auction->id }}" style="font-size: 18px; line-height: 24px; color: #007BFF; font-weight: bold;">{{__('Click here to see this auction')}} </a>
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