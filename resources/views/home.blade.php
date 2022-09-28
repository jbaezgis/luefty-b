@extends('layouts.app2')
@section('title', __('Home'))
@section('description', __('World\'s first fair trade tourism auctions'))
@section('keywords', 'Tourism Services, Attractions, Transportation, Tours, Save 60%, Fair Trade Tourism, No Agency Fees, Save More, Spend Less, Global Auctions, Amazing Deals')
@section('og-image', asset('images/image-cover.png'))
@section('og-image-url', asset('images/image-cover.png'))

@section('head')
{{-- <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script> --}}
{{-- <script src="{{ asset('parrot-animation/home/home-parrot.js') }}"></script> --}}

@endsection

@section('content')

@if( session()->has('error') )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {!! session('error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="position-relative overflow-hidden bg-light slider">
    <div class="container-fluid">
        {{-- <div class="parrot-flying d-none d-sm-none d-md-block"></div> --}}
        <div class="row">
            {{-- PC --}}
            <div class="col-md-12 text-center d-none d-sm-none d-md-block">
                <img src="{{asset('images/home/logo-travel-auctions.svg')}}" height="150" alt="Luefty Travel Auctions">
            </div>
            {{-- Mobile --}}
            <div class="col-md-12 text-center d-block d-sm-block d-md-none">
                <img class="img-fluid" src="{{asset('images/home/logo-travel-auctions.svg')}}" alt="Luefty Travel Auctions">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center text-white custom-text-shaddow-2">
                {{-- <h1 class="display-3" >{{ __('Where do you want to go?') }} </h1>
                <p></p>
                <h3 class="">{{ __('BIDS CAN BE 60% LESS BECAUSE OF EMPTY LEGS, EMPTY SEATS AND IDLE TIME') }} </h3> --}}
                <div class="container">
                    <div class="row mb-4 justify-content-center bg-white-transparent p-3 rounded">
                        <div class="col-md-6">
                            <select class="custom-select custom-select-lg" onchange="window.location.href=this.value;">
                                <option style="color:blue" selected>{{__('Quality Transfers')}}</option>
                                <optgroup label="{{__('Dominican Republic')}}">
                                    <option value="{{url('country/dominican-republic/transfers')}}">Dominican Republic</option>
                                    <option value="{{url('country/dominican-republic/punta-cana/transfers')}}">Punta Cana</option>
                                    <option value="{{url('country/dominican-republic/santo-domingo/transfers')}}">Santo Domingo</option>
                                    <option value="{{url('country/dominican-republic/puerto-plata/transfers')}}">Puerto Plata</option>
                                </optgroup>
                                <optgroup label="{{__('Spain')}}">
                                    <option value="{{url('country/spain/transfers')}}">Spain</option>
                                    <option value="{{url('country/spain/mallorca/transfers')}}">Mallorca</option>
                                    <option value="{{url('country/spain/ibiza/transfers')}}">Ibiza</option>
                                    <option value="{{url('country/spain/barcelona/transfers')}}">Barcelona</option>
                                    <option value="{{url('country/spain/gran-canaria/transfers')}}">Gran Canaria</option>
                                    <option value="{{url('country/spain/lanzarote/transfers')}}">Lanzarote</option>
                                    <option value="{{url('country/spain/tenerife/transfers')}}">Tenerife</option>
                                    <option value="{{url('country/spain/madrid/transfers')}}">Madrid</option>
                                </optgroup>
                                <optgroup label="{{__('Mexico')}}">
                                    <option value="{{url('country/mexico/transfers')}}">Mexico</option>
                                    <option value="{{url('country/mexico/cancun/transfers')}}">Cancun</option>
                                    <option value="{{url('country/mexico/puerto-vallarta/transfers')}}">Puerto Vallarta</option>
                                    <option value="{{url('country/mexico/mexico-city/transfers')}}">Mexico City</option>
                                </optgroup>
                                <optgroup label="{{__('Turkey')}}">
                                    <option value="{{url('country/turkey/transfers')}}">Turkey</option>
                                    <option value="{{url('country/turkey/istanbul/transfers')}}">Istanbul</option>
                                    <option value="{{url('country/turkey/antalya/transfers')}}">Antalya</option>
                                    <option value="{{url('country/turkey/izmir/transfers')}}">Izmir</option>
                                </optgroup>
                            </select>
                        </div>
                        {{-- <div class="col-md-4">
                            <select class="custom-select custom-select-lg " onchange="window.location.href=this.value;">
                                <option selected>{{__('Popular Destinations')}}</option>
                                <optgroup label="{{__('Dominican Republic')}}">
                                    <option value="{{url('country/dominican-republic/transfers')}}">Dominican Republic</option>
                                    <option value="{{url('country/dominican-republic/punta-cana/transfers')}}">Punta Cana</option>
                                    <option value="{{url('country/dominican-republic/santo-domingo/transfers')}}">Santo Domingo</option>
                                    <option value="{{url('country/dominican-republic/puerto-plata/transfers')}}">Puerto Plata</option>
                                </optgroup>
                                <optgroup label="{{__('Spain')}}">
                                    <option value="{{url('country/spain/transfers')}}">Spain</option>
                                    <option value="{{url('country/spain/mallorca/transfers')}}">Mallorca</option>
                                    <option value="{{url('country/spain/ibiza/transfers')}}">Ibiza</option>
                                    <option value="{{url('country/spain/barcelona/transfers')}}">Barcelona</option>
                                    <option value="{{url('country/spain/gran-canaria/transfers')}}">Gran Canaria</option>
                                    <option value="{{url('country/spain/lanzarote/transfers')}}">Lanzarote</option>
                                    <option value="{{url('country/spain/tenerife/transfers')}}">Tenerife</option>
                                    <option value="{{url('country/spain/madrid/transfers')}}">Madrid</option>
                                </optgroup>
                                <optgroup label="{{__('Mexico')}}">
                                    <option value="{{url('country/mexico/transfers')}}">Mexico</option>
                                    <option value="{{url('country/mexico/cancun/transfers')}}">Cancun</option>
                                    <option value="{{url('country/mexico/puerto-vallarta/transfers')}}">Puerto Vallarta</option>
                                    <option value="{{url('country/mexico/mexico-city/transfers')}}">Mexico City</option>
                                </optgroup>
                                <optgroup label="{{__('Turkey')}}">
                                    <option value="{{url('country/turkey/transfers')}}">Turkey</option>
                                    <option value="{{url('country/turkey/istanbul/transfers')}}">Istanbul</option>
                                    <option value="{{url('country/turkey/antalya/transfers')}}">Antalya</option>
                                    <option value="{{url('country/turkey/izmir/transfers')}}">Izmir</option>
                                </optgroup>
                            </select>
                        </div> --}}
                        <div class="col-md-6">
                            <select class="custom-select custom-select-lg " onchange="window.location.href=this.value;">
                                <option selected>{{__('Best Tours')}}</option>
                                <optgroup label="{{__('Dominican Republic')}}">
                                    <option value="https://tours.luefty.com/destination/dominican-republic/">Dominican Republic</option>
                                    <option value="https://tours.luefty.com/destination/punta-cana/">Punta Cana</option>
                                    <option value="https://tours.luefty.com/destination/santo-domingo/">Santo Domingo</option>
                                    <option value="https://tours.luefty.com/destination/puerto-plata/">Puerto Plata</option>
                                </optgroup>
                                <optgroup label="{{__('Spain')}}">
                                    <option value="https://tours.luefty.com/destination/spain/">Spain</option>
                                    <option value="https://tours.luefty.com/destination/mallorca/">Mallorca</option>
                                    <option value="https://tours.luefty.com/destination/ibiza/">Ibiza</option>
                                    <option value="https://tours.luefty.com/destination/barcelona/">Barcelona</option>
                                    <option value="https://tours.luefty.com/destination/gran-canaria/">Gran Canaria</option>
                                    <option value="https://tours.luefty.com/destination/Lanzarote/">Lanzarote</option>
                                    <option value="https://tours.luefty.com/destination/tenerife/">Tenerife</option>
                                    <option value="https://tours.luefty.com/destination/madrid/">Madrid</option>
                                </optgroup>
                                <optgroup label="{{__('Mexico')}}">
                                    <option value="https://tours.luefty.com/destination/mexico/">Mexico</option>
                                    <option value="https://tours.luefty.com/destination/cancun/">Cancun</option>
                                    <option value="https://tours.luefty.com/destination/puerto-vallarta/">Puerto Vallarta</option>
                                    <option value="https://tours.luefty.com/destination/mexico-city/">Mexico City</option>
                                </optgroup>
                                <optgroup label="{{__('Turkey')}}">
                                    <option value="https://tours.luefty.com/destination/turkey/">Turkey</option>
                                    <option value="https://tours.luefty.com/destination/istanbul/">Istanbul</option>
                                    <option value="https://tours.luefty.com/destination/antalya/">Antalya</option>
                                    <option value="https://tours.luefty.com/destination/izmir/">Izmir</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Parrot PC--}}
            <div class="col-md-12 text-center d-none d-sm-none d-md-block">
                {{-- <a href="{{url('/messages/create')}}">
                    <img src="{{asset('images/contact-button.png')}}" height="130" alt="Luefty contact">
                </a> --}}
                {{-- <img src="{{asset('images/parrot/home.png')}}" height="300" alt="Luefty Parrot"> --}}
            </div>

            {{-- Parrot Mobile --}}
            <div class="col-md-12 text-center d-block d-sm-block d-md-none">
                {{-- <a href="{{url('/messages/create')}}">
                    <img src="{{asset('images/contact-button.png')}}" height="80" alt="Luefty contact">
                </a> --}}
                {{-- <img class="img-fluid" src="{{asset('images/parrot/home.png')}}" alt="Luefty Parrot"> --}}
            </div>
        </div>

        {{-- <div class="parrot d-none d-sm-block">
            <div style="margin:0px;">
                <div id="animation_container" style="width:512px; height:384px">
                    <canvas id="canvas" width="512" height="384" style="position: absolute; display: block; "></canvas>
                    <div id="dom_overlay_container" style="pointer-events:none; overflow:hidden; width:512px; height:384px; position: absolute; left: 0px; top: 0px; display: block;">
                    </div>
                </div>
            </div>
        </div>
    
        <div class="parrot-mobile d-block d-sm-none">
            <img class="img-fluid" src="{{asset('images/home/parrot.gif')}} " alt="money">
        </div> --}}
        
        {{-- PC --}}
        {{-- <div class=" pr-4 d-none d-sm-none d-md-block">
            <div class="row text-center">
                <div class="col-md-6"><img class="" src="{{asset('images/home/tripadvisor_rated.png')}}" height="200" alt="tripadvisor"></div>
                <div class="col-md-6"><img class="" src="{{asset('images/home/trustpilot_rated.png')}}" height="200" alt="trustpilot"></div>
            </div>
        </div> --}}

        {{-- Mobile --}}
        {{-- <div class=" pr-4 d-block d-sm-block d-md-none">
            <div class="d-flex">
                <div class="p-2 flex-fill"><img class="img-fluid" src="{{asset('images/home/tripadvisor_rated.png')}}" alt="tripadvisor"></div>
                <div class="p-2 flex-fill"><img class="img-fluid" src="{{asset('images/home/trustpilot_rated.png')}}" alt="trustpilot"></div>
            </div>
        </div> --}}
    </div>{{-- container-fluid --}}
    
    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-none d-sm-none d-md-block">
                    <div class="d-flex flex-row justify-content-center">
                        {{-- <div class="">
                            <a href="" data-toggle="modal" data-target="#audioModal">
                                <img  src="{{asset('images/parrot/home-bubble-left.png')}}" width="300" alt="Luefty Bubble left">
                            </a>
                        </div> --}}
                        <div class="">
                            {{-- <img class="" src="{{asset('images/parrot/home-parrot.png')}}" width="150" alt="Luefty Parrot for Video"> --}}
                        </div>
                        <!-- <div class="">
                            <a href="" data-toggle="modal" data-target="#exampleModal">
                                <img  src="{{asset('images/parrot/home-bubble-right.png')}}" width="300" alt="Luefty Bubble right">
                            </a>
                        </div> -->
                    </div>
                </div>

                <div class="row justify-content-center d-block d-sm-block d-md-none">
                    {{-- <div class="col-md-4">
                        <a href="" data-toggle="modal" data-target="#audioModal">
                            <img  src="{{asset('images/parrot/home-square-bubble-left.png')}}" width="300" alt="Luefty Bubble left">
                        </a>
                    </div> --}}
                    <div class="col-md-4 text-right">
                        <a href="" data-toggle="modal" data-target="#exampleModal">
                            <img  src="{{asset('images/parrot/home-square-bubble-right.png')}}" width="300" alt="Luefty Bubble right">
                        </a>
                    </div>
                    <div class="col-md-4 text-center">
                        <img class="" src="{{asset('images/parrot/home-parrot.png')}}" width="220" alt="Luefty Parrot for Video">
                    </div>
                </div>
                {{-- <a href="" data-toggle="modal" data-target="#exampleModal">
                    <img class="img-fluid" src="{{asset('images/parrot/home-for-video.png')}}" alt="Luefty Parrot for Video">
                </a> --}}
                
            </div>
            <div class="col-md-4 text-center">
                {{-- <div class="card">
                    <div class="card-body text-center">
                        <a href="" data-toggle="modal" data-target="#exampleModal">
                            <img class="img-fluid" src="{{asset('images/video_thumb.png')}}" alt="Live Auction">
                        </a>
                    </div>
                </div> --}}
                <br>
            
                <!--Video Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Live Auction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                            <div class="modal-body">
                                <div class="embed-responsive embed-responsive-16by9">
                                    {{-- <iframe src="https://www.youtube.com/embed/iRVP57tl0U0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
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
            </div>
        </div>

    </div>
    <div class="">
       <div class="row ">
           <div class="col-md-6"></div>
           <div class="col-md-6 text-right d-none d-sm-none d-md-block ">
                <div class="pb-2 mr-4">
                    <a href="{{url('/messages/create')}}">
                        <img src="{{asset('images/contact-button.png')}}" height="130" alt="Luefty contact">
                    </a>
                </div>
           </div>

           <div class="col-md-6 text-right d-block d-sm-block d-md-none">
                <div class="pb-2 mr-2">
                    <a href="{{url('/messages/create')}}">
                        <img src="{{asset('images/contact-button.png')}}" height="80" alt="Luefty contact mobile">
                    </a>
                </div>
            </div>
       </div>
   </div>

</div> {{-- slider --}}

<div class="bg-primary">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center py-4">
                <h2>{{__('World\'s First Fair Trade Tourism Auctions')}}</h2>
                <p>{{__('Prices as low as 50% with the very best suppliers because you buy DIRECT with us! No agency fees.')}}</p>
            </div>
        </div>
    </div>
</div>

<div class="container">

    <div class="row mt-4 mb-4 justify-content-center">
        <div class="col-md-9 text-center">
            {{-- <h2 class="">{{__('Popular destinations, tours and transfers')}}</h2> --}}
            {{-- <h2>{{__('Popular')}} <span class="text-yellow-luefty">{{__('Destinations')}} </span></h2> --}}
            {{-- <div class="divider my-3"></div> --}}
            {{-- <span class="text-muted">{{__('World\'s best tourist destinations')}}</span> --}}
        </div>
    </div>
    {{-- <div class="row mb-4">
        <div class="col-md-12">
            <div class="row">
                @foreach ($countries as $item)
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/'.$item->slug.'/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('storage/images/countries/'.$item->id.'/thumb/'.$item->image)}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2 text-yellow-luefty">{{$item->en_name}}</h4>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div> --}}
</div>

<div class="container">
    <div class="row">
        {{-- Left column --}}
        {{-- <div class="col-md-3">
            <img class="img-fluid" src="{{asset('images/parrot/left.png')}}" alt="Luefty Parrot">
        </div> --}}
        <div class="col-md-12">
            {{-- Dominican Republic --}}
            <div class="row">
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/dominican-republic/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/dr/thumb/dr.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Dominican Republic')}}</h4>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/dominican-republic/punta-cana/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/dr/thumb/punta_cana.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Punta Cana')}} <br> <small>Dominican Republic</small></h4>
                            
                        </div>
                    </div>
                    </a>
                </div>
        
                {{-- <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/dominican-republic/samana/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/dr/thumb/samana.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Saman�')}} <br> <small>Dominican Republic</small></h4>
                        </div>
                    </div>
                    </a>
                </div> --}}
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/dominican-republic/santo-domingo/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/dr/thumb/santo_domingo.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Santo Domingo')}} <br> <small>Dominican Republic</small></h4>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/dominican-republic/puerto-plata/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/dr/thumb/puerto-plata.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Puerto Plata')}} <br> <small>Dominican Republic</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="row">
            </div>
        
            {{-- Spain --}}
            <div class="row">
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/spain/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/es/thumb/spain.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Spain')}}</h4>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/spain/mallorca/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/es/thumb/mallorca.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Mallorca')}} <br><small>{{__('Spain')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/spain/ibiza/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/es/thumb/ibiza.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Ibiza')}}<br><small>{{__('Spain')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/spain/barcelona/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/es/thumb/barcelona.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Barcelona')}}<br><small>{{__('Spain')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/spain/gran-canaria/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/es/thumb/gran-canaria.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Gran Canaria')}}<br><small>{{__('Spain')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/spain/lanzarote/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/es/thumb/lanzarote.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Lanzarote')}} <br><small>{{__('Spain')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/spain/tenerife/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/es/thumb/tenerife.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Tenerife')}}<br><small>{{__('Spain')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/spain/madrid/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/es/thumb/madrid.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Madrid')}}<br><small>{{__('Spain')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        
            {{-- Mexico --}}
            <div class="row">
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/mexico/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/mx/thumb/mexico.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Mexico')}}</h4>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/mexico/cancun/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/mx/thumb/cancun.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Cancun')}}<br><small>{{__('Mexico')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/mexico/puerto-vallarta/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/mx/thumb/puerto-vallarta.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Puerto Vallarta')}}<br><small>{{__('Mexico')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/mexico/mexico-city/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/mx/thumb/mexico-city.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Mexico City')}}<br><small>{{__('Mexico')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        
            {{-- Turkey --}}
            <div class="row">
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/turkey/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/tr/thumb/turkey.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Turkey')}}</h4>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/turkey/istanbul/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/tr/thumb/istanbul.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Istanbul')}}<br><small>{{__('Turkey')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/turkey/antalya/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/tr/thumb/antalya.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Antalya')}}<br><small>{{__('Turkey')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url('country/turkey/izmir/transfers')}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('images/home/tr/thumb/izmir.png')}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay pl-2">
                            <h4 class="country_name custom-text-shaddow-2">{{__('Izmir')}}<br><small>{{__('Turkey')}}</small></h4>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Whales options --}}
{{-- <div class="container mt-3">
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <img class="rounded img-fluid" src="{{URL::asset('img/whales/whales_siteRecurso_6image_.png')}}" alt=""> <br>
                    <h4>{{(__('Humpback Whales of Samana'))}}</h4>
                    <span class="text-muted">Every year around the 15th of January, like clockwork, the famous Humpback whales of Samana arrive, having traveled all the way from the North Atlantic to relax and frolic in the warm waters of the Caribbean, a bit like you and me!</span>
                    <p></p>
                    <a href="{{url('whales')}} " class="btn btn-primary">{{__('More details')}}</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                @foreach ($whales as $item)
                    <div class="col-md-4 mb-2">
                        <div class="card">
                                <a href="{{url('whales/'.$item->slug)}}">
                                    <img src="{{asset('storage/images/whales/'.$item->image)}}" class="card-img-top" alt="...">
                                </a>
                                <div class="card-body">
                                <h5 class="card-title ">{{$item->title}}</h5><br>
                                <small>{{__('from')}}</small> <strong>${{ number_format($item->price, 2, '.', ',') }}</strong>
                                </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2 text-center text-muted py-4">
            <i class="fa fa-ticket fa-lg" aria-hidden="true"></i> <br>
            345,000+ Things to Do
        </div>
        <div class="col-md-2 text-center text-muted py-4">
            <i class="fa fa-star-o fa-lg" aria-hidden="true"></i> <br>
            Millions of Reviews
        </div>
        <div class="col-md-3 text-center text-muted py-4">
            <i class="fa fa-tag fa-lg" aria-hidden="true"></i> <br>
            Lowest Price Guarantee
        </div>
        <div class="col-md-2 text-center text-muted py-4">
            <i class="fa fa-mobile fa-lg" aria-hidden="true"></i> <br>
            24/7 Global Support
        </div>
        <div class="col-md-2 text-center text-muted py-4">
            <i class="fa fa-tripadvisor fa-lg" aria-hidden="true"></i> <br>
            A Tripadvisor Company
        </div>
    </div>
</div> --}}

{{-- <div class="row my-4">
    <div class="col-md-12 text-center py-4 bg-info-light">
        <h2>{{__('WORLD\'S FIRST FAIR TRADE TOURISM AUCTIONS')}}</h2>
        <p class="lead text-muted">{{__('Bids can be 60% less because of empty legs, empty seats and idle time.')}}</p>
    </div>
</div> --}}

<div class="container">
    <div class="row ">
        <div class="col-md-12 text-center">
            {{-- <div class="bg-warning p-2 rounded">
            </div> --}}
            {{-- <h2 class="">{{__('Recomendated Tours')}}</h2> --}}
            {{-- <h2>{{__('Dominican Republic')}} <span class="text-yellow-luefty">{{__('Attractions')}} </span></h2>--}}
            {{-- <div class="divider my-3"></div>  --}}
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        {{-- <div class="col-md-5">
            <div class="p2">
                <a href="{{url('attraction/'. $last_attraction->slug)}}">
                    <img src="{{URL::asset('storage/images/attractions/'. $last_attraction->image)}}" class="rounded-lg img-fluid" alt="{{$last_attraction->image}}">
                </a>
                <div class="py-1 ">
                    <div class="text-truncate">
                        <span class="">{{$last_attraction->title}}</span>
                    </div>
                    <small class="text-muted">{{$last_attraction->tours->count()}} {{__('Tours and Activity')}}</small><br>
                </div>
            </div>
        </div> --}}
        <div class="col-md-7">
        </div>
        {{-- <div class="row">
            @foreach($attractions as $item)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <a href="{{url('country/'.$item->country->slug.'/'. $item->slug.'/attraction')}}">
                            <img src="{{URL::asset('storage/images/attractions/'. $item->image)}}" class="img-fluid" alt="{{$item->image}}">
                        </a>
                        <div class="attraction-count bg-warning px-2 rounded-left">
                            <span >{{$item->tours->count()}} {{__('Tours and Activity')}}</span><br>
                        </div>
                        <div class="attraction-body pl-2">
                            
                            <h5 class="custom-text-shaddow-2 text-yellow-luefty">{{$item->title}}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}
    </div>
    {{-- <div class="row justify-content-center">
        <div class="col-md-6">
            <a href="#" class="btn btn-light btn-block btn-lg"> {{__('SEE MORE')}}</a>
        </div>
    </div> --}}
    
</div>

{{-- Why book your transfers with Luefty? --}}
{{-- <div class="py-2">
    <div class="container">
        <div class="row pb-3">
            <div class="col-md-12 text-center">
                <h3 class="">{{__('Why book your transfers with Luefty?')}}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="p-2"><img class="img-fluid" src="{{asset('images/home/pagar.svg')}} " width="60" alt="pay"></div>
                <div class="p-2">
                    <span class="text-info">{{__('Direct Sale')}}</span><br>
                    <small class="text-muted">{{__('You are buying direct from the carefully selected local suppliers. Your saving will be up to 60% because there are no intermediaries.')}}</small>
                </div>

            </div>
            <div class="col-md">
                <div class="p-2"><img class="img-fluid" src="{{asset('images/home/cerdo.svg')}} " width="60" alt="pork"></div>
                <div class="p-2">
                    <span class="text-info">{{__('Auction Pricing')}}</span><br>
                    <small class="text-muted">{{__('You can Buy Now or Join the Luefty Auctions and save tons of money. In the Auctions suppliers are happy to offer incredible prices because that is better than driving home empty or standing idle.')}}</small>
                </div>
            </div>
            <div class="col-md">
                <div class="p-2"><img class="img-fluid" src="{{asset('images/home/descuento.svg')}} " width="60" alt="desc"></div>
                <span class="text-info">{{__('Fair Trade')}}</span><br>
                <small class="text-muted">{{__('The drivers and suppliers in our auction keep 100% of their price and drive when they want to. No more huge margins going to intermediariesl You win, the local business wins and Luefty wins. This is Fair Trade.')}}</small>
                
            </div>
        </div>
        <hr>
    </div>
</div> --}}

{{-- <div class="container">
    <div class="row py-4">
        <div class="col-md-12 text-center">
            <h3>{{__('Top Destinations')}}</h3>
        </div>
    </div>
</div> --}}

{{-- <div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="row">
                @foreach ($locations as $item)
                <div class="col-md-3 text-truncate mb-3">
                    <a href="{{url($item->slug)}}" class="text-decoration-none">
                    <div class="card text-white border-0">
                        <img src="{{asset('storage/images/locations/'.$item->image)}}" class="card-img rounded-lg" alt="$item->img">
                        <div class="card-img-overlay text-center">
                            <h5 class=" pt-5 custom-text-shaddow">{{$item->name}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div> --}}



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
    //  $('.input-number').inputSpinner()
    // $("input[type='number']").inputSpinner()

    $("#from").change(function() {
        $('#button').removeClass("desabled");
    });
</script>

<script>
    function fromValue(){
        $('select[name="from"]').on('change', function(){
            var inputVal = document.getElementById("from").value;
        });
    }
</script>

<script>
    function undisable_to() {
        var to = document.getElementById("to");
        to.removeAttr("disabled");
    }

    function undisable() {
        var oneway_btn = document.getElementById("oneway-btn");
        var roundtrip_btn = document.getElementById("roundtrip-btn");

        oneway_btn.classList.remove("disabled");
        roundtrip_btn.classList.remove("disabled");

        document.getElementById("oneway").disabled = false;
        document.getElementById("roundtrip").disabled = false;
    }

	// $(document).ready(function(){
    //     var oneway = document.getElementById("oneway").disabled = true;
    //     var roundtrip = document.getElementById("roundtrip").disabled = true;

	// 	$('select[name="to"]').on('change', function(){
    //         var oneway = document.getElementById("oneway").disabled = false;
    //         var roundtrip = document.getElementById("roundtrip").disabled = false;
	// 	});
	// });
</script>
<script>
	// $(document).ready(function(){

		$('select[name="from"]').on('change', function(){
            
            // $( "#to" ).prop( "disabled", false );
            //To enable 
            $('#to').removeAttr('disabled');

			var from = $(this).val();

			if(from){
				console.log(from);
				$.ajax({
					url: 'servicesto/' + from,
					type: 'GET',
					dataType: 'json',
					success: function(data){
						// console.log(data);
						$('#to').empty();
						$('#to').append('<option value="" disable="true" selected="true">Drop off Location</option>');

						$.each(data, function(index, toObj){
							$('#to').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
							// $('#tail-select-to').append('<option value="'+ toObj.id +'">' + toObj.name + '</option>');
                            // newAddItem.push({ key: toObj.id, value: toObj.name, description: "" })
						})
					}
				});
			}
		});

	// });
</script>

<script>
    $('.carousel').carousel({
        pause: "false"
    });
</script>

@endsection
