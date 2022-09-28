@extends('layouts.app2')
@section('title', __('Transfer').': '. $service->fromLocation->name . ' ' . __('To') . ' ' . $service->toLocation->name)
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('content')
<div class="py-5 country-image " style="background-image: url('/images/slide.png');">
    <div class="container"> 
        <div class="">
            <div class="parrot-flying d-none d-sm-none d-md-block"></div>
            <div class="row justify-content-center">
                
                    <div class="col-md-10 d-none d-sm-none d-md-block">
                        <a href="{{url('/messages/create')}}">
                            <img src="{{asset('images/contact-button.png')}}" height="130" alt="Luefty contact">
                        </a>
                        <img src="{{asset('images/parrot/country_region_auctions_active.png')}}" height="300" alt="Luefty Parrot">
                    </div>

                    <div class="col-md-8 d-block d-sm-block d-md-none text-center">
                        <a href="{{url('/messages/create')}}">
                            <img src="{{asset('images/contact-button.png')}}" height="80" alt="Luefty contact">
                        </a>
                        <img class="img-fluid" src="{{asset('images/parrot/country_region_auctions_active.png')}}" alt="Luefty Parrot">
                    </div>
            </div>
        </div>

    </div>
    
</div>

<div class="container">

    <div class="d-none d-sm-none d-md-block">

        <div class="d-flex flex-row mb-2">
            <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                <span class="text-primary font-weight-bolder">{{__('From')}}:</span>
                <span class="font-weight-bold">{{$service->fromLocation->name}} </span>
            </div>

            <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                <span class="text-primary font-weight-bolder">{{__('To')}}:</span>
                <span class="font-weight-bold">{{$service->toLocation->name}} </span>
            </div>
        </div>

        {!! Form::open(['method' => 'GET', 'url' => 'transfer/'.$service->fromLocation->slug.'/'.$service->toLocation->slug, 'role' => 'search'])  !!}
        <div class="d-flex flex-row">
            <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                {{-- <input type="text" class="form-control datepicker2 border-0" id="date" name="date" aria-describedby="dateErrors" placeholder="{{ __('Pick up date')}}" required> --}}
                {!! Form::text('date', null, ['class' => 'form-control datepicker2 border-0', 'required' => 'required', 'id'=>'date', 'placeholder'=>__('Pick up date'), 'onchange'=> 'this.form.submit()']) !!}
            </div>
            {{-- <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                <input type="text" class="form-control border-0" id="pickupdate" name="pickupdate" aria-describedby="dateErrors" placeholder="{{ __('Pick up date')}}" required>
            </div> --}}

            <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                {{-- <input type="text" class="form-control datepicker2 border-0" id="add_return" name="add_return" aria-describedby="dateErrors" placeholder="{{ __('Add return')}}"> --}}
                {!! Form::text('return_date', null, ['class' => 'form-control datepicker2 border-0', 'required' => 'required', 'id'=>'return_date', 'placeholder'=>__('Add return'), 'onchange'=> 'this.form.submit()']) !!}
            </div>

            <div class="p-2 pr-3 mr-2 flex-fill blue-border border-rounded">
                {{-- <select class="form-control border-0 pax" id="pax" name="passengers" onchange="this.form.submit()" value="{{ old('passengers') }}">
                    <option value="1">1 {{__('Passenger')}}</option>
                    <option value="2">2 {{__('Passengers')}}</option>
                    <option value="3">3 {{__('Passengers')}}</option>
                    <option value="4">4 {{__('Passengers')}}</option>
                    <option value="5">5 {{__('Passengers')}}</option>
                    <option value="6">6 {{__('Passengers')}}</option>
                    <option value="7">7 {{__('Passengers')}}</option>
                    <option value="8">8 {{__('Passengers')}}</option>
                    <option value="9">9 {{__('Passengers')}}</option>
                    <option value="10">10 {{__('Passengers')}}</option>
                </select> --}}
                {!! Form::select('passengers', 
                array('1' => '1 Passenger', 
                    '2' => '2 Passengers',
                    '3' => '3 Passengers',
                    '4' => '4 Passengers',
                    '5' => '5 Passengers',
                    '6' => '6 Passengers',
                    '7' => '7 Passengers',
                    '8' => '8 Passengers',
                    '9' => '9 Passengers',
                    '10' => '10 Passengers',
                    '11' => '11 Passengers',
                    '12' => '12 Passengers',
                    '13' => '13 Passengers',
                    '14' => '14 Passengers',
                ), 
                null, ['class' => 'form-control border-0 pax', 'id'=>'pax', 'required' => 'required', 'onchange'=> 'this.form.submit()']) !!}

            </div>
        </div>
        {!! Form::close() !!}

    </div>
    <br>
    
    <div class="row">
        <div class="col-md-4 d-none d-sm-none d-md-block">
            {{-- <div class="">
                <a href="" data-toggle="modal" data-target="#audioModal">
                    <img  src="{{asset('images/parrot/home-square-bubble-left.png')}}" width="300" alt="Luefty Bubble left">
                </a>
            </div> --}}
            <div class=" text-right">
                <a href="" data-toggle="modal" data-target="#exampleModal">
                    <img  src="{{asset('images/parrot/home-square-bubble-right.png')}}" width="300" alt="Luefty Bubble right">
                </a>
            </div>
            <div class=" text-center">
                <img class="" src="{{asset('images/parrot/home-parrot.png')}}" width="220" alt="Luefty Parrot for Video">
            </div>
        
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Live Auction</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                </div>
                    <div class="modal-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            {{-- <iframe src="https://www.youtube.com/embed/iRVP57tl0U0?rel=0;controls=0;showinfo=0;theme=light" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay=1; clipboard-write; encrypted-media; gyroscope; picture-in-picture; modestbranding=1" allowfullscreen></iframe> --}}
                            <video src="{{asset('videos/live_auctions.mp4')}}" controls autoplay loop></video>
                        </div>
                    </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>

        <!--Audio Modal -->
        <div class="modal fade" id="audioModal" tabindex="-1" aria-labelledby="audioModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="audioModalLabel">Live Auction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                    <div class="modal-body text-center">
                        <img class="" src="{{asset('images/parrot/home-parrot.png')}}" width="150" alt="Luefty Parrot for Video">
                        <audio id="audio" controls>
                            <source src="{{asset('audios/short-explanation.mp3')}}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                <div class="modal-footer">
                <button id="close-audio" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>

            {{-- <img class="img-fluid" src="{{asset('images/parrot/left.png')}}" alt="Luefty Parrot"> --}}
        </div>
        <div class="col-md-8">
            @foreach ($services_options as $item)
                <div class="shadow-sm vehicle-li mb-3 p-3">

                    {{-- PC --}}
                    <div class="d-none d-sm-none d-md-block">
                        <div class="d-flex">
                            <div class="p-2 mr-2 flex-fill blue-border border-rounded">
                                <span class="text-primary font-weight-bolder">{{__('Vehicle type')}}: </span> <span class="font-weight-bolder">{{ $item->vehicle->type }}</span>
                            </div>
                            <div class="p-2 mr-2 flex-fill blue-border border-rounded">
                                <span class="text-primary font-weight-bolder">{{__('Max passengers')}}: </span> <span class="font-weight-bolder">{{ $item->priceOption->max_passengers }}</span>
                            </div>
                            <div class="p-2 flex-fill blue-border border-rounded">
                                <span class="text-primary font-weight-bolder">{{__('Driving time')}}: </span> 
                                <span class="font-weight-bolder">
                                    @if ($item->service->driving_time > 60)
                                        {{date('H'.' \h\o\u\r\s \a\n\d '. 'i'.' \m\i\n\s', mktime(0,$item->service->driving_time))}}
                                    @else
                                        {{date('i'.' \m\i\n\s', mktime(0,$item->service->driving_time))}}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Mobile --}}
                    <div class="d-block d-sm-block d-md-none">
                        <div class="d-flex flex-column">
                            <div class="p-2 mb-2 flex-fill blue-border border-rounded">
                                <span class="text-primary font-weight-bolder">{{__('Vehicle type')}}: </span> <span class="font-weight-bolder">{{ $item->vehicle->type }}</span>
                            </div>
                            <div class="p-2 mb-2 flex-fill blue-border border-rounded">
                                <span class="text-primary font-weight-bolder">{{__('Max passengers')}}: </span> <span class="font-weight-bolder">{{ $item->priceOption->max_passengers }}</span>
                            </div>
                            <div class="p-2 flex-fill blue-border border-rounded">
                                <span class="text-primary font-weight-bolder">{{__('Driving time')}}: </span> 
                                <span class="font-weight-bolder">
                                    @if ($item->service->driving_time > 60)
                                        {{date('H'.' \h\o\u\r\s \a\n\d '. 'i'.' \m\i\n\s', mktime(0,$item->service->driving_time))}}
                                    @else
                                        {{date('i'.' \m\i\n\s', mktime(0,$item->service->driving_time))}}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center my-3">
                            <h5 class="text-primary">{{__('BOOK NOW TO SEE FIRST BID(S), 50% PRICE DROPS ARE NOT UNUSUAL!')}}</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 text-center">
                            @if ( $item->vehicle->type == 'Sedan')
                                <img class="" src="{{ asset('images/vehicles/Sedan.jpeg') }}" height="100" alt="Vehicle">
                            @elseif ($item->vehicle->type == 'Minivan')
                                <img class="" src="{{ asset('images/vehicles/Minivan.jpeg') }}" height="100" alt="Vehicle2">
                            @elseif ($item->vehicle->type == 'Minibus')
                                <img class="" src="{{ asset('images/vehicles/Minibus.jpeg') }}" height="100" alt="Vehicle3">
                            @elseif ($item->vehicle->type == 'Small Bus')
                                <img class="" src="{{ asset('images/vehicles/LargeVan.jpeg') }}" height="100" alt="Vehicle4">
                            @endif
                        </div>

                        <div class="col-md-6 pt-4">
                            @section('price')
                                {{ $percentaje = $item->oneway_price * 0.10}}
                                {{ $price = $item->oneway_price + $percentaje }}
                                {{ $rt_price = $price * 2 }}
                            @endsection
                            {!! Form::open(['method' => 'POST', 'url' => '/booking/store'])  !!}
                            {{-- {!! Form::open(['method' => 'PATCH', 'url' => ['/booking/assign/service', $auction->id], 'style' => 'display:inline']) !!} --}}
            
                                {{ Form::hidden('service_id', $service->id) }}
                                {{ Form::hidden('from', $service->fromLocation->id) }}
                                {{ Form::hidden('to', $service->toLocation->id) }}
                                {{ Form::hidden('vehicleid', $item->vehicle->id) }}
                                {{ Form::hidden('service_price_id', $item->id) }}
                                {{ Form::hidden('date', $request->date) }}
                                {{ Form::hidden('return_date', $request->return_date) }}
                                {{ Form::hidden('passengers', $request->passengers) }}
                                {{-- <input class="pickupdate" name="date" type="hidden" value=""> --}}
                                {{-- <input class="return_date" name="return_date" type="hidden" value=""> --}}
                                {{-- <input class="passengers" name="passengers" type="hidden" value="1"> --}}

                                {!! Form::button(__('CONTINUE AUCTION!'), array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-primary btn-block btn-lg green-border font-weight-bolder continue-btn',
                                        'title' => __('CONTINUE AUCTION'),
                                        'disabled' => 'disabled'
                                )) !!}
                            {!! Form::close() !!}
                            <div class="text-center">
                                <small class="select-date-alert text-danger">{{__('Please select a -Pick up date- before continuing!')}} </small>
                            </div>
                        </div>
                    </div>
                </div>{{-- car option box --}}
            @endforeach
            {{-- end options results --}}

        </div>

        {{-- mobile --}}
        <div class="col-md-4 d-block d-sm-block d-md-none text-center">
            <div class="row">
                {{-- <div class="col-md-4">
                    <a href="" data-toggle="modal" data-target="#audioMobileModal">
                        <img  src="{{asset('images/parrot/home-square-bubble-left.png')}}" width="300" alt="Luefty Bubble left">
                    </a>
                </div> --}}
                <div class="col-md-4 text-right">
                    <a href="" data-toggle="modal" data-target="#modalmobile">
                        <img  src="{{asset('images/parrot/home-square-bubble-right.png')}}" width="300" alt="Luefty Bubble right">
                    </a>
                </div>
                <div class="col-md-4 text-center">
                    <img class="" src="{{asset('images/parrot/home-parrot.png')}}" width="220" alt="Luefty Parrot for Video">
                </div>
            </div>

            <div class="modal fade" id="modalmobile" tabindex="-1" aria-labelledby="modalmobileLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="modalmobileLabel">Live Auction</h5>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                    </div>
                        <div class="modal-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                {{-- <iframe src="https://www.youtube.com/embed/iRVP57tl0U0?rel=0;controls=0;showinfo=0;theme=light" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                                <video src="{{asset('videos/live_auctions.mp4')}}" controls autoplay loop></video>
                            </div>
                        </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>

            <!--Audio Modal -->
            <div class="modal fade" id="audioMobileModal" tabindex="-1" aria-labelledby="audioModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="audioModalLabel">Live Auction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                        <div class="modal-body text-center">
                            <img class="" src="{{asset('images/parrot/home-parrot.png')}}" width="150" alt="Luefty Parrot for Video">
                            <audio id="audio" controls>
                                <source src="{{asset('audios/short-explanation.mp3')}}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    <div class="modal-footer">
                    <button id="close-audio" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
  
</div>

@endsection

@section('scripts')
<script>
    var audio = document.getElementById('audio');
    var button = document.getElementById('close-audio');
    
    $('#audioModal').on('shown.bs.modal', function () {
        audio.play();
    })

    button.addEventListener('click', playPause, false);

    function playPause() {
        if (!audio.paused) {
            audio.pause();
            // audio.currentTime = 0; // Uncomment this line for stop
            button.classList.remove('pause');
            button.classList.add('play');
        } else {
            audio.play();
            button.classList.remove('play');
            button.classList.add('pause');
        }
    }
</script>

    <script>
        // $("#date").on("change", function() {
        //     var selected = $(this).val();
        //     $('#pickupdate').val(selected);
        // });

        // $('#pickup').keyup(function() {
        //     $('.pickupdate').val($(this).val());
        // });
        $("#from").change(function() {
        
        });

        if($('#date').val()) {
            // $('.pickupdate').val($(this).val());
            $('.continue-btn').prop("disabled", false);
            $('.select-date-alert').hide();
        }

        // if($('#add_return').val()) {
        //     $('.return_date').val($(this).val());
        // }

        // if($('#pax').val()) {
        //     $('.passengers').val($(this).val());
        // }


        // $('#date').on("change", function() {
        //     $('.pickupdate').val($(this).val());
        //     $('.continue-btn').prop("disabled", false);
        //     $('.select-date-alert').hide();
        // });

        // $('#add_return').on("change", function() {
        //     $('.return_date').val($(this).val());
        // });

        // $('#pax').on("change", function() {
        //     $('.passengers').val($(this).val());
        // });
    </script>
@endsection
