<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{__('Bid Accepted')}} | Luefty</title>

    <style type="text/css">
        h1, h2, h3, h4, h5, h6 {
          margin-top: 0;
          margin-bottom: 0.5rem;
        }
        p {
          margin-top: 0;
          margin-bottom: 1rem;
        }

        a {
          color: #007bff;
          text-decoration: none;
          background-color: transparent;
        }

        a:hover {
          color: #0056b3;
          text-decoration: underline;
        }

        img {
          vertical-align: middle;
          border-style: none;
        }

        svg {
          overflow: hidden;
          vertical-align: middle;
        }

        h1, h2, h3, h4, h5, h6,
        .h1, .h2, .h3, .h4, .h5, .h6 {
          margin-bottom: 0.5rem;
          font-family: inherit;
          font-weight: 500;
          line-height: 1.2;
          color: inherit;
        }

        h1, .h1 {
          font-size: 2.5rem;
        }

        h2, .h2 {
          font-size: 2rem;
        }

        h3, .h3 {
          font-size: 1.75rem;
        }

        h4, .h4 {
          font-size: 1.5rem;
        }

        h5, .h5 {
          font-size: 1.25rem;
        }

        h6, .h6 {
          font-size: 1rem;
        }

        hr {
          margin-top: 1rem;
          margin-bottom: 1rem;
          border: 0;
          border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        small,
        .small {
          font-size: 80%;
          font-weight: 400;
        }
        .button {
          background-color: #4CAF50; /* Green */
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
        }

        .container {
            max-width: 520px;
            }
        /* @media (min-width: 1200px)
        _grid.scss:6.container {
        max-width: 1140px;
        }
        @media (min-width: 992px)
        _grid.scss:6.container {
        max-width: 960px;
        }
        @media (min-width: 768px)
        _grid.scss:6.container {
        max-width: 720px;
        }
        @media (min-width: 576px)
        _grid.scss:6.container {
        max-width: 540px;
        }*/
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            /* margin-right: auto;
            margin-left: auto; */
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        .title {
          background-color: #f8f9fa;
          color: #212529;
        }

        .footer {
          background-color: #f8f9fa;
          color: #212529;
        }

        .badge-success {
            color: #fff;
            background-color: #28a745;
        }

        .badge {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
        }

        .btn {
          display: inline-block;
          font-weight: 400;
          color: #212529;
          text-align: center;
          vertical-align: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
          background-color: transparent;
          border: 1px solid transparent;
          padding: 0.375rem 0.75rem;
          font-size: 1rem;
          line-height: 1.5;
          border-radius: 0.25rem;
          transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn-primary {
          color: #fff;
          background-color: #007bff;
          border-color: #007bff;
        }

        .btn-primary:hover {
          color: #fff;
          background-color: #0069d9;
          border-color: #0062cc;
        }

        .btn-primary:focus, .btn-primary.focus {
          box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        }

        .text-left {
          text-align: left !important;
        }

        .text-right {
          text-align: right !important;
        }

        .text-center {
          text-align: center !important;
        }
        a:not([href]):not([tabindex]) {
          color: inherit;
          text-decoration: none;
        }

        a:not([href]):not([tabindex]):hover, a:not([href]):not([tabindex]):focus {
          color: inherit;
          text-decoration: none;
        }

        a:not([href]):not([tabindex]):focus {
          outline: 0;
        }

    </style>
  </head>
  <body>
    <div class="container" style="background:">
        <div class="text-center">
            <h4>{{__('Your bid was accepted!')}}</h4>
        {{ __('Here you have all the details of the auction and information of the auctioneer.')}}
        </div>
        <hr>
        <p style=""><strong>{{ __('Auction details:')}}</strong></p>
        <p></p>
         <p style="">{{ __('From') }} <strong>{{ $msg->auction->fromcity->name  }}</strong> {{ __('To') }} <strong>{{ $msg->auction->tocity->name  }}</strong></p>
         <p>{{ __('Category')}}: <strong>{{ $msg->auction->category->name }}</strong></p>
         <p></p>
         <p>{{ __('Starting bid for one seat') }}: <strong>${{ number_format($msg->auction->starting_bid, 2, '.', ',') }}</strong> |
            {{ __('Seats available') }}:
            <span class="{{ $msg->auction->category_id === 1 ? 'text-primary' : 'text-success'}} ">
                <strong>{{ $msg->auction->passengers }} / {{ $msg->auction->shared_seats }}</strong>
            </span>
        </p>

         <p style=""><strong>{{ __('Details of your bid:')}}</strong></p>
         <p>
             {{ __('Seats') }}: <strong>{{ $msg->seats }}</strong> | {{ __('Bid by seat') }}: <strong>${{ number_format($msg->bid, 2, '.', ',') }}</strong> | {{ _('Total') }}: <strong>${{ number_format($msg->total, 2, '.', ',') }}</strong>
         </p>

        {{ __('Click')}} <a href="{{ url('/mybids/showauction/'.$msg->auction->id) }}" class=""><strong>{{ __('here')}}</strong></a> {{ __('to see this auction')}}

        <hr>
        <p style=""><strong>{{ __('Contact info:')}}</strong></p>
        <p class="card-text">{{ __('Company') }}: {{ $msg->auction->user->company_name }}</p>
        <p class="card-text">{{ __('Contact name') }}: {{ $msg->auction->user->name }}</p>
        <p class="card-text">{{ __('Email') }}: {{ $msg->auction->user->email }}</p>
        <p class="card-text">{{ __('Phone') }}: {{ $msg->auction->user->phone }}</p>
        <hr>
        <div class="text-center">
            <p><img class="mb-2" src="https://luefty.com/images/logo.png" alt="" height="40"></p>
            <p><small class="d-block mb-3 text-muted">&copy; {{ date('Y')}} - luefty.com</small></p>
        </div>

    </div>

  </body>
</html>