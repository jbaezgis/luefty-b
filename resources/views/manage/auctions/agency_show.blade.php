@extends('layouts.app2')
@section('title', __('Booking: ') . $auction->auction_id)
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<br>

<div class="container">
    {{-- @section('best_bid')
    {{ $bestbid = $bids->where('auction_id', $auction->id)->min('bid') }}
    {{ $mybid = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->min('bid') }}
    @endsection --}}
    @section('best_bid')
    {{ $bestbid = $bids->where('auction_id', $auction->id)->min('bid') }}
    {{ $mybid2 = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->first() }}
    {{ $options = __('Example') . ': ' . __('If you select') . ' ' . '<b>' . '$5' . '</b>' . ' ' . __('and ') . '<b>' . __('Best bid') . ' = $' . $bestbid . '.00'.'</b>' . ', ' . __('your bid will be') . ' ' . '<b>' . '$' . ($bestbid - 5) . '.00' .'</b>' }}
    {{ $mybid = $bids->where('auction_id', $auction->id)->where('user_id', auth()->user()->id)->min('bid') }}
    {{ $starting_bid = $auction->starting_bid }}
    {{ $max = $starting_bid - 1 }}
    {{ $min = ($bestbid * 80)/100 }}

    @if ($bids->where('auction_id', $auction->id)->count() > 0)
        {{ $max = $starting_bid - 1 }}
        {{ $min = ($bestbid * 80)/100 }}
    @else
        {{ $max = $starting_bid - 1 }}
        {{ $min = ($starting_bid * 80)/100 }}
    @endif
@endsection

<div class="row">
    <div class="col-md-12 text-right">
        <span class="text-primary" id="p1">{{url('booking/confirmation/'.$auction->key)}}</span>
        <button class="btn btn-primary btn-sm" onclick="copyToClipboard('#p1')">{{__('Copy URL')}}</button>
        |
        @if ($auction->checked_by)
            <span><i class="fa fa-check text-success" aria-hidden="true"></i> {{__('Checked by')}}: <strong>{{$auction->checkedBy->name}}</strong></span>
        @else
            {!! Form::open([
                'method' => 'PATCH',
                'url' => ['manageauctions/checked', $auction->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button(__('Check Auction'), array(
                        'type' => 'submit',
                        'class' => 'btn btn-success btn-sm',
                        'title' => 'Check Auction'
                )) !!}
            {!! Form::close() !!}
        @endif
    </div>
</div>
<hr>

{{-- Auctions details --}}
<div class="row">
    <div class="col-3 border-right">
        <div class="mb-2">
            <small>{{__('Agency')}}:</small>
            <h5 class="mb-0 pb-0">{{$auction->user->name}}</h5>
            <span class="">{{$auction->user->company_name}}</span><br>
        </div>
        
        <hr>
        <small class="font-weight-bold text-muted">{{__('Status')}}:</small>
        @if ($auction->changed === 1 & $auction->status === 'Closed')
            <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
        @elseif ($auction->changed === 1)
            <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is Changed because you updated its info') }}" data-placement="top">{{ __('Changed')}} </span>
        @else
            @if ($auction->status == 'Closed')
                <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ __('This Auction is Closed because you accepted a bid.') }}" data-placement="top">{{ __('Closed')}}</span>
            @else
                @if ($auction->bids->count() > 0)
                    <span class="badge badge-pill badge-warning" data-toggle="tooltip" title="{{ __('This Auction is Open because has one bid or more.') }}" data-placement="top">{{ __('Open') }}</span>
                @else
                    <span class="badge badge-pill badge-light" data-toggle="tooltip" title="{{ __('This Auction is do not have bids.') }}" data-placement="top">{{ __('No bid yet') }}</span>
                @endif
            @endif
        @endif

        

    </div>

        <div class="col-9">
            <div class="d-flex flex-row">
                
                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Service Number')}}</small> <br>
                        <span class="font-weight-bold">{{$auction->service_number}} </span>
                    </div>
                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Date')}}</small> <br>
                        <span class="font-weight-bold">{{$auction->date}}, {{ date('g:ia', strtotime($auction->time)) }}</span>
                    </div>

                    <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Starting Bid')}}</small> <br>
                        <span class="font-weight-bold">
                            {{$auction->country->currency_symbol}}{{ number_format($auction->starting_bid, 2, '.', ',') }}
                        </span>
                    </div>

                     <div class="p-2 pr-3">
                        <small class="font-weight-bold text-uppercase text-muted">{{__('Passeners')}}</small> <br>
                        <span class="font-weight-bold">{{$auction->passengers}}</span>
                    </div>
            </div>

            <div class="d-flex flex-row">
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('From')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->fromcity['name']}}</span>
                </div>
    
                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('To')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->tocity['name']}}</span>
                </div>

                

            </div>

            <div class="d-flex flex-row">

                <div class="p-2 pr-3">
                    <small class="font-weight-bold text-uppercase text-muted">{{__('More information')}}</small> <br>
                    <span class="font-weight-bold">{{$auction->more_information}}</span>
                </div>
            </div>
        </div>

</div>
<hr>

<div class="card">
    <div class="card-body">
        <form method="POST" class="needs-validation" action="{{ route('bids.agencyBidStore') }}" novalidate>
            {{ csrf_field() }}
            <input type="hidden" id="auction_id" name="auction_id" value="{{ $auction->id }} ">
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control select2 { $errors->has('lang') ? 'has-error' : '' }}" id="user_id" name="user_id" value="{{ old('user_id') }}">
                        <option value="" disabled selected>{{__('Select User')}}</option>
                        @foreach ($users as $item)
                            <option value="{{$item->id}}">{{$item->name}} ({{$item->company_name}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="input-group ">
                        <div class="input-group-prepend" style="display: block;">
                            <div class="input-group-text">{{ $auction->country->currency_symbol }}</div>
                        </div>
                        <input type="number" step=".01" min="{{ $min }}" class="form-control {{ $errors->has('bid') ? 'is-invalid' : '' }}" placeholder="0.00" id="bid" name="bid" value="{{old('bid')}}" required>
                        <br>
                        <div class="invalid-feedback">
                            {{ __('The bid must be between') }} <strong>{{ $auction->country->currency_symbol }}{{ number_format($min, 0, '.', ',') }}</strong> {{ __('and') }} <strong>${{ number_format($max, 0, '.', ',') }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('Add')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <h4>{{__('Bids')}} <small>({{ $auction->bids->count() }})</small></h4>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th >{{ __('Supplier') }}</th>
                                <th >{{ __('Email') }}</th>
                                <th >{{ __('Phone') }}</th>
                                <th>{{ __('Bid')}}</th>
                                <th>{{ __('Bidded at')}}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
            
                            @foreach ($bids as $key => $bid)
                            {{-- @if () --}}
                            <tr class="">
                                <td>{{ $bid->user->name }}</td>
                                <td>{{ $bid->user->email }}</td>
                                <td>{{ $bid->user->phone }}</td>
                                <td><strong>{{$auction->country->currency_symbol}}{{ number_format($bid->bid, 2, '.', ',') }}</strong></td>
                                <td>{{ $bid->updated_at->diffForHumans() }}</td>
            
                                <td>
                                    @if($bid->won == 1)
                                        <span class="badge badge-success">{{__('Accepted')}} </span>
                                    @endif

                                    @if ($auction->status == "Open")
                                        {!! Form::open([
                                            'method' => 'PATCH',
                                            'url' => ['booking/accept-bid', $bid->id],
                                            'style' => 'display:inline',
                                            'class' => 'accept'
                                            // 'onsubmit' => 'return ConfirmDelete()'
                                        ]) !!}
                                            {{ Form::hidden('auction_id', $auction->id) }}

                                            <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" title="{{ __('Do you want to accept this bid?') }}" data-placement="right"><i class="fa fa-check" aria-hidden="true" ></i></button>
                                        {!! Form::close() !!}

                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/bids', $bid->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'data-toggle'=>'tooltip',
                                                    'data-placement'=>'top',
                                                    'title'=>__('Delete Bid?'),
                                                    'class' => 'btn btn-danger btn-sm',
                                                    // 'title' => 'Delete Bid'
                                                    'onclick'=>'return confirm("Confirm?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    @endif
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

@endsection

@section('scripts')
    <script>
        function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("url");
    
        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */
    
        /* Copy the text inside the text field */
        document.execCommand("copy");
    
        /* Alert the copied text */
        alert("Copied the text: " + copyText.value);
    }
    </script>

    <script>
        function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
        }
    </script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endsection
